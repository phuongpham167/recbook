<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\Project;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function getList()
    {
        $list = Project::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('projects')->select('id', 'name')->whereNull('deleted_at')->get();
        return $data;
    }

    public function getProjectByProvince($provinceId)
    {
        $projects = Project::where('province_id', $provinceId)->select('id', 'name')->get();
        return $projects;
    }

    public function store($input)
    {
        $project = new Project();
        $project->name = $input['name'];
        $project->description = $input['description'];
        if($project->save()) {
            return $project;
        } else {
            return false;
        }
    }
}