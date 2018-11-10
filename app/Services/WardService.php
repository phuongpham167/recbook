<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/30/2018
 * Time: 1:15 AM
 */

namespace App\Services;


use App\Ward;
use Illuminate\Support\Facades\DB;

class WardService
{
    public function getList()
    {
        $list = Ward::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('ward')->select('id', 'name')->get();
        return $data;
    }

    public function getWardByDistrict($districtId)
    {
        $wards = Ward::where('district_id', $districtId)->select('id', 'name')->get();
        return $wards;
    }
}