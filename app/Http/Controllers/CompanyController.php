<?php

namespace App\Http\Controllers;

use App\CGroup;
use App\Company;
use App\Customer;
use App\Http\Requests\CreateCompanyRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
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
        return v('company.list-member');
    }

    public function data() {
        $data   =   Company::find(\request('id'))->users()->get();



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
            ->addColumn('manage', function( $user) {
                return a('xoa-thanh-vien', 'id='.$user->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                    "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('doanh-nghiep/xoa-thanh-vien?id='.$user->id)."')}})");
            })->rawColumns([ 'manage']);

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Currency $currency) {
//                return Web::find($currency->web_id)->name;
//            });
//        }

        return $result->make(true);
    }

    public function addUser() {
        $user = User::find(\request('user_id'));

        if(!empty($user) && Company::find(\request('company_id'))->user_id == auth()->user()->id) {
            $user->company()->attach(\request('company_id'));
            $group = CGroup::where('company_id',\request('company_id'))->where('is_default',1)->first();
            $user->companygroup()->attach($group);
            set_notice(trans('system.add_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function removeUser() {
        $user = User::find(\request('id'));

        if(!empty($user) && CGroup::find($user->companygroup()->first()->pivot->group_id)->user_id == auth()->user()->id ) {
            $user->companygroup()->detach($user->companygroup()->first()->pivot->group_id);
            $user->company()->detach($user->company()->first()->pivot->company_id);
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }

    public function listCustomer() {
        return v('company.list');
    }

    public function dataListCustomer(){
        $data   =   Customer::with('type');
        $group = DB::table('company_groups')->where('company_id', \request('id'))->pluck('id');
        $group_id = DB::table('group_user')->whereIn('group_id', $group)->where('user_id',auth()->user()->id)->first()->group_id;
        $groupMember = DB::table('group_user')->where('group_id',$group_id)->where('confirmed',1)->pluck('user_id');

        $group_user = [];
        $group_agency = [];
        foreach ($groupMember as $user){
            if(is_agency($group_id, User::find($user))){
                $group_agency[] = $user;
            }else
                $group_user[] = $user;
        }

        $data   =   $data->where(function ($q) use ($group_user){
            $q->whereIn('user_id', $group_user)->orWhere('user_id', auth()->user()->id);
        });
        $result = Datatables::of($data)
            ->editColumn('name', function(Customer $customer){
                return "<a href='".route('customerCare', ['id'=>$customer->id])."'>".$customer->name."</a>";
            })
            ->editColumn('phone', function(Customer $customer){
                return "<a href='".route('customerCare', ['id'=>$customer->id])."'>".$customer->phone."</a>";
            })
            ->addColumn('type', function(Customer $customer) {
                return $customer->type?$customer->type->name:'-';
            })->addColumn('manage', function(Customer $customer) {
                return a('khach-hang/xoa', 'id='.$customer->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',"return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('khach-hang/xoa?id='.$customer->id)."')}})").'  '.a('khach-hang/sua', 'id='.$customer->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage', 'name', 'phone']);

        return $result->make(true);
    }

    public function getGroup($id)
    {
        if(!is_admin($id, auth()->user()->id))
            return redirect()->route('companyDetail', ['id'=>$id]);
        $company =   Company::findOrFail($id);
        if($company){
            $groups =   $company->group()->get();
            $company_id =   $id;
            return v('company.group.list', compact('groups', 'company_id'));
        }
        return redirect()->route('companyDetail', ['id'=>$id]);
    }
}
