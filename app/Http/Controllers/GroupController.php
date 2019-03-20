<?php

namespace App\Http\Controllers;

use App\Company;
use App\CGroup;
use App\Group;
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

    public function detail($id)
    {
        $group  =   CGroup::find($id);
        if($group && in_array(get_role($group->company_id, auth()->user()->id), ['admin', 'manager'])){
            return v('company.group.detail', ['data'=>$group]);
        }
    }

    public function addUser()
    {
        $group  =   CGroup::find(request('group_id'));
        if(!empty($group)){
            $role   =   get_role($group->company_id);
            if($role == 'admin' || $role == 'manager'){
                $member =   explode(',', request('members'));
                $confirmed  =   $role=='admin'?1:0;
                foreach($member as $u){
                    $current_group  =   find_group($id, $u);
                    if($current_group)
                        $current_group->users()->detach($u);
                    $group->users()->attach($u, ['confirmed'=>$confirmed]);
                }
                if($confirmed==0){
                    notify($members, 'Lời mời vào nhóm', (auth()->user()->userinfo?auth()->user()->userinfo->fullname:auth()->user()->name).' mời bạn vào nhóm '.$group->name, route('confirmGroup', ['id'=>$group->id]));
                }
            }
        }
    }
}
