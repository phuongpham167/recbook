<?php

namespace App\Http\Controllers;

use App\CGroup;
use App\Company;
use App\Customer;
use App\Http\Requests\CreateCompanyRequest;
use App\RealEstate;
use App\RelatedCustomer;
use App\Scopes\PrivateScope;
use App\Services\BlockService;
use App\Services\DirectionService;
use App\Services\DistrictService;
use App\Services\ExhibitService;
use App\Services\ProjectService;
use App\Services\ProvinceService;
use App\Services\ReCategoryService;
use App\Services\StreetService;
use App\Services\WardService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    protected $reCategoryService;
    protected $provinceService;
    protected $districtService;
    protected $wardService;
    protected $streetService;
    protected $directionService;
    protected $exhibitService;
    protected $projectService;

    public function __construct(
        ReCategoryService $reCategoryService,
        ProvinceService $provinceService,
        DistrictService $districtService,
        WardService $wardService,
        StreetService $streetService,
        DirectionService $directionService,
        ExhibitService $exhibitService,
        ProjectService $projectService,
        BlockService $blockService
    )
    {
        $this->reCategoryService = $reCategoryService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->wardService = $wardService;
        $this->streetService = $streetService;
        $this->directionService = $directionService;
        $this->exhibitService = $exhibitService;
        $this->projectService = $projectService;
        $this->blockService = $blockService;
    }

    public function index()
    {
        $data   =   new Company();
        $data   =   $data->whereHas('users', function($q){
            $q->where('users.id', auth()->user()->id);
        });

        $data   =   $data->paginate(10);
        return v('company.index', compact('data'));
    }

    public function create()
    {
        return v('company.create');
    }

    public function save(CreateCompanyRequest $request)
    {
        $data   =   new Company();
        $data->name     =   $request->name;
        $data->address  =   $request->address;
        $data->user_id  =   auth()->user()->id;
        $data->description  =   $request->description;
        $data->status   =   'active';
        $data->created_at   =   Carbon::now();
        $data->save();
        $data->users()->attach(auth()->user()->id, ['confirmed'=>1]);
        $members    =   explode(',',$request->members);
        $data->users()->attach($members);

        $group = $data->group()->create([
            'name'  =>  'Nhóm chính',
            'user_id'   =>  auth()->user()->id,
            'description'   =>  'Nhóm mặc định của '.$data->name,
            'is_default'  =>  1,
        ]);
        $group->users()->attach(auth()->user()->id, ['confirmed'=>1, 'role'=>'admin']);
        $group->users()->attach($members);
        set_notice('Tạo doanh nghiệp thành công!<br/>Thêm thành viên vào doanh nghiệp thành công. Vui lòng chờ xác nhận.', 'success');
        notify($members, 'Lời mời vào doanh nghiệp', (auth()->user()->userinfo?auth()->user()->userinfo->fullname:auth()->user()->name).' mời bạn vào '.$data->name, route('confirmCompany', ['id'=>$data->id]));
        return redirect()->route('companyIndex');
    }

    public function edit()
    {
        $data   =   Company::find(\request('id'));
        return v('company.edit',compact('data'));
    }

    public function update(CreateCompanyRequest $request)
    {
        $data   =   Company::find($request->id);

        if(!empty($data) && get_role($request->id, auth()->user()->id) == 'admin'){
            $data->name     =   $request->name;
            $data->address  =   $request->address;
            $data->description  =   $request->description;
            $data->save();
            set_notice('Sửa doanh nghiệp thành công!', 'success');
        }else
            set_notice('Doanh nghiệp không tồn tại hoặc bạn không có quyền sửa doanh nghiệp này!', 'warning');

        return redirect()->route('companyIndex');
    }

    public function delete(){
        $data   =   Company::find(request('id'));
        $groups = $data->group()->get();

        foreach ($groups as $group){
            $group->users()->sync([]);
        }

        if(!empty($data)){
            $data->users()->sync([]);
            $data->group()->delete();
            set_notice('Xóa doanh nghiệp thành công!', 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function confirm()
    {
        $data   =   Company::where('id', request('id'))->whereHas('users', function($q){
            $q->where('users.id', auth()->user()->id);
        })->first();
        $confirmed  =   $data->users()->where('user_id', auth()->user()->id)->first()->pivot->confirmed;
        if($confirmed == 1)
            return redirect()->route('companyDetail', ['id'=>$data->id]);
        if(request('confirmed')==1){
            $pivot  =   $data->users()->updateExistingPivot(auth()->user()->id, ['confirmed'=>1]);
            set_notice('Tham gia doanh nghiệp thành công!', 'success');
            return redirect()->route('companyDetail', ['id'=>$data->id]);
        }else
            return v('company.confirm', compact('data', 'confirmed'));
    }

    public function realEstateData()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->pluck('id')->toArray();
        $data   =   RealEstate::whereIn('customer_id', $customer)->withoutGlobalScope(PrivateScope::class);
        $result = Datatables::of($data)
            ->addColumn('title', function(RealEstate $item){
                return "<a href='".route('customerCare', ['id'=>$item->customer_id,'re_id' => $item->id])."'>".$item->title."</a>";
            })
            ->addColumn('type', function(RealEstate $item){
                return $item->reType?$item->reType->name:'';
            })->rawColumns(['title']);

        return $result->make(true);
    }
    public function show()
    {
        $company_id = auth()->user()->company()->first()->pivot->company_id;
        return v('company.list-member',compact('company_id'));
    }

    public function data($id) {
        $role   =   get_role($id);

        if($role == 'admin'){
            $data   =   Company::find($id)->users()->having('confirmed', 1)->get();
        } else {
            $data   =   get_user_same_group($id);
        }

        if(!empty($data)){
            $result = Datatables::of($data)
                ->editColumn('name', function($user){
                    return $user->name;
                })
                ->editColumn('group', function( $user){
                    return CGroup::find($user->companygroup()->first()->pivot->group_id)->name;
                })
                ->addColumn('permission', function( $user) {
                    return $user->rolegroup()->first()->pivot->role;
                })
                ->addColumn('manage', function( $user) use ($id) {
                    return a('doanh-nghiep/xoa-thanh-vien', 'id='.$user->id.'&company_id='.$id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                        "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('doanh-nghiep/xoa-thanh-vien?id='.$user->id.'&company_id='.$id)."')}})");
                })->rawColumns([ 'manage']);

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Currency $currency) {
//                return Web::find($currency->web_id)->name;
//            });
//        }

            return $result->make(true);
        }


    }

    public function addUser() {
        $members    =   explode(',',\request('user_id'));
        $company = Company::find(\request('company_id'));
        if(!empty($members) && get_role(\request('company_id'), auth()->user()->id) == 'admin') {
            $company->users()->attach($members);
            $group = CGroup::where('company_id',\request('company_id'))->where('is_default',1)->first();
            $group->users()->attach($members);
            notify($members, 'Lời mời vào doanh nghiệp', (auth()->user()->userinfo?auth()->user()->userinfo->fullname:auth()->user()->name).' mời bạn vào '.$company->name, route('confirmCompany', ['id'=>$company->id]));
            set_notice(trans('system.add_user_company_success'), 'success');
        }else
            set_notice(trans('system.add_user_failed'), 'warning');
        return redirect()->back();
    }

    public function removeUser() {
        $user = User::find(\request('id'));

        if(!empty($user) && get_role(\request('company_id'), auth()->user()->id) == 'admin' ) {
            $user->companygroup()->detach($user->companygroup()->first()->pivot->group_id);
            $user->company()->detach($user->company()->first()->pivot->company_id);
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function listCustomer() {
        $company_id = auth()->user()->company()->first()->pivot->company_id;
        return v('company.list',compact('company_id'));
    }

    public function dataListCustomer(){
        $data   =   Customer::with('type');
        $group  =   find_group(request('id'));
        $role   =   get_role(request('id'));
        $data = $data->whereHas('realestate', function ($re) use ($group, $role) {
            $re->where('company_id', request('id'));

            if($role !='admin'){
                $re->whereHas('user', function ($u) use ($group, $role) {
                    $u->where('id', auth()->user()->id)->orWhereHas('rolegroup', function ($g) use ($group, $role) {
                        $g->where('group_id', $group->id);
                        if($role != 'manager')
                            $g->having('role', '=', 'user');
                    });
                });
            }
        });


        $result = Datatables::of($data)
            ->editColumn('name', function(Customer $customer){
                return "<a href='".route('customerCare', ['company_id'=>request('id'),'id'=>$customer->id])."'>".$customer->name."</a>";
            })
            ->editColumn('phone', function(Customer $customer){
                return "<a href='".route('customerCare', ['company_id'=>request('id'),'id'=>$customer->id])."'>".$customer->phone."</a>";
            })
            ->addColumn('type', function(Customer $customer) {
                return $customer->type?$customer->type->name:'-';
            })->rawColumns(['name', 'phone']);

        return $result->make(true);
    }

    public function getGroup($id)
    {
        if (!is_admin($id, auth()->user()->id))
            return redirect()->route('companyDetail', ['id' => $id]);
        $company = Company::findOrFail($id);
        if ($company) {
            $groups = $company->group()->get();
            $company_id = $id;
            return v('company.group.list', compact('groups', 'company_id'));
        }
        return redirect()->route('companyDetail', ['id' => $id]);
    }
    public function listRE() {
        $company_id = request('company_id');
        $reCategories = $this->reCategoryService->getListDropDown();
        $provinces = $this->provinceService->getListDropDown();
        $directions = $this->directionService->getListDropDown();
        $exhibits = $this->exhibitService->getListDropDown();
        return v('company.listRE',compact('company_id','reCategories',
                    'provinces', 'directions', 'exhibits'));
    }

    public function dataListRE(){
        $data   =   RealEstate::query();
        $data   =   $data->withoutGlobalScope(PrivateScope::class);
        $group  =   find_group(request('id'));
        $role   =   get_role(request('id'));
        $data = $data->where('company_id', request('id'));
        if($role != 'admin') {
            $data = $data->whereHas('user', function ($u) use ($group, $role) {
                $u->where('id', auth()->user()->id)->orWhereHas('rolegroup', function ($g) use ($group, $role) {
                    $g->where('group_id', $group->id);
                    if($role!='manager'){
                        $g->having('role', '=', 'user');
                    }
                });
            });
        }


        $result = Datatables::of($data)->addColumn('type', function(RealEstate $item){
            return $item->reType?$item->reType->name:'';
        });
        return $result->make(true);
    }
}
