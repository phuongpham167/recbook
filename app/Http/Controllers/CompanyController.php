<?php

namespace App\Http\Controllers;

use App\CGroup;
use App\Company;
use App\Http\Requests\CreateCompanyRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DataTables;

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

    public function listMember()
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
                return a('doanh-nghiep/thanh-vien/xoa', 'id='.$user->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                    "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('doanh-nghiep/thanh-vien/xoa?id='.$user->id)."')}})");
            })->rawColumns([ 'manage']);

//        if(get_web_id() == 1) {
//            $result = $result->addColumn('web_id', function(Currency $currency) {
//                return Web::find($currency->web_id)->name;
//            });
//        }

        return $result->make(true);
    }

    public function addMember() {
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

    public function deleteMember() {
        $user = User::find(\request('id'));

        if(!empty($user) && CGroup::find($user->companygroup()->first()->pivot->group_id)->user_id == auth()->user()->id ) {
            $user->companygroup()->detach($user->companygroup()->first()->pivot->group_id);
            $user->company()->detach($user->company()->first()->pivot->company_id);
            set_notice(trans('system.delete_success'), 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');
        return redirect()->back();
    }
}
