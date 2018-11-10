<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/26/2018
 * Time: 12:11 AM
 */

namespace App\Services;
use App\District;
use Illuminate\Support\Facades\DB;

class DistrictService
{
    public function getList()
    {
        $list = District::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('district')->select('id', 'name')->get();
        return $data;
    }

    public function getDistrictByProvince($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->select('id', 'name')->get();
        return $districts;
    }
}