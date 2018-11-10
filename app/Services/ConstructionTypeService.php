<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\ConstructionType;
use Illuminate\Support\Facades\DB;

class ConstructionTypeService
{
    public function getList()
    {
        $list = ConstructionType::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('construction_types')->select('id', 'name')->get();
        return $data;
    }

    public function store($input)
    {
        $reCategory = new ConstructionType();
        $reCategory->name = $input['name'];
        $reCategory->description = $input['description'];
        if($reCategory->save()) {
            return $reCategory;
        } else {
            return false;
        }
    }
}