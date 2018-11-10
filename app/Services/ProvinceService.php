<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/30/2018
 * Time: 12:45 AM
 */

namespace App\Services;
use App\Province;
use Illuminate\Support\Facades\DB;

class ProvinceService
{
    public function getList()
    {
        $list = Province::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('province')->select('id', 'name')->get();
        return $data;
    }
}