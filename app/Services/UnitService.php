<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\Unit;
use Illuminate\Support\Facades\DB;

class UnitService
{
    public function getList()
    {
        $list = Unit::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('units')->select('id', 'name')->get();
        return $data;
    }

    public function store($input)
    {
        $reCategory = new Unit();
        $reCategory->name = $input['name'];
        $reCategory->description = $input['description'];
        if($reCategory->save()) {
            return $reCategory;
        } else {
            return false;
        }
    }
}