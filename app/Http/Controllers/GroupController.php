<?php

namespace App\Http\Controllers;

use App\Company;
use App\CGroup;
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
}
