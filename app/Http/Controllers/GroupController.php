<?php

namespace App\Http\Controllers;

use App\Company;
use App\CGroup;
use App\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create($id)
    {
        return v('company.group.create', ['company_id'=>$id]);
    }

    public function save($id)
    {
        $group  =   new CGroup();
        $group->company_id  =   $id;
        $group->name    =   request('name');
        $group->description =   \request('description');
        $group->created_at  =   Carbon::now();
        $group->user_id =   auth()->user()->id;
        $group->save();
        $member =   explode(',', request('members'));
        foreach($member as $u){
            $current_group  =   find_group($id, $u);
            if($current_group)
                $current_group->users()->detach($u);
            $group->users()->attach($u, ['confirmed'=>1]);
        }
        set_notice('Tạo nhóm mới thành công', 'success');
        return redirect()->back();
    }

    public function edit()
    {
        $group = CGroup::find(request('id'));
        return v('company.group.edit', compact('group'));
    }

    public function update()
    {
        $group  =   CGroup::find(\request('id'));
        if(!empty($group) && is_admin($group->company_id)) {
            $group->name    =   request('name');
            $group->description =   \request('description');
            $group->save();
            set_notice('Sửa nhóm thành công', 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function delete()
    {
        $group  =   CGroup::find(\request('id'));
        if(!empty($group) && is_admin($group->company_id)) {
            $group->users()->sync([]);
            $group->delete();
            set_notice('Xóa nhóm thành công', 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function detail($id)
    {
        $group  =   CGroup::find($id);
        if($group && in_array(get_role($group->company_id, auth()->user()->id), ['admin', 'manager'])){
            return v('company.group.detail', ['data'=>$group]);
        }
    }

    public function deleteUser(){
        $data   =   User::find(request('id'));
        $group  =   CGroup::find(\request('group_id'));
        if(!empty($data) && in_array(get_role($group->company_id, auth()->user()->id), ['admin', 'manager'])){
            $data->companygroup()->where('group_id',\request('group_id'))->sync([]);
            set_notice('Xóa thành viên nhóm thành công!', 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

        return redirect()->back();
    }

    public function updateUser(){
        $data   =   User::find(request('id'));
        $group  =   CGroup::find(\request('group_id'));
        if(!empty($data) && in_array(get_role($group->company_id, auth()->user()->id), ['admin', 'manager'])){
            $data->rolegroup()->updateExistingPivot(request('group_id'), ['role'=>\request('role')]);

            set_notice('Sửa cấp độ thành viên thành công!', 'success');
        }else
            set_notice(trans('system.not_exist'), 'warning');

//        return response('a');
        return redirect()->back();
    }

    public function addUser()
    {
        $group  =   CGroup::find(request('group_id'));
        if(!empty($group)){
            $role   =   get_role($group->company_id);
            if($role == 'admin' || $role == 'manager'){
                $member =   explode(',', request('members'));
                $confirmed  =   $role=='admin'?1:0;
//                $confirmed  =   0;
                foreach($member as $u){
                    $current_group  =   find_group($group->company_id, $u);
                    if($current_group)
                        $current_group->users()->detach($u);
                    $group->users()->attach($u, ['confirmed'=>$confirmed]);
                }
                if($confirmed==0){
                    notify($member, 'Lời mời vào nhóm', (auth()->user()->userinfo?auth()->user()->userinfo->fullname:auth()->user()->name).' mời bạn vào nhóm '.$group->name, route('confirmGroup', ['id'=>$group->id]));
                }
                set_notice('Đã thêm thành viên vào nhóm. Vui lòng đợi thành viên xác nhận!!', 'success');
            }
        }
        return redirect()->back();
    }

    public function confirm()
    {
        $data   =    CGroup::find(request('id'));

        $confirmed  =   $data->users()->where('user_id', auth()->user()->id)->first()->pivot->confirmed;
        if($confirmed == 1)
            return redirect()->route('companyGroupDetail', ['id'=>$data->id]);
        if(request('confirmed')==1){
            $pivot  =   $data->users()->updateExistingPivot(auth()->user()->id, ['confirmed'=>1]);
            set_notice('Tham gia nhóm thành công!', 'success');
            return redirect()->route('companyDetail', ['id'=>$data->company_id]);
        }else
            return v('company.group.confirm', compact('data', 'confirmed'));
    }
}
