<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/26/2018
 * Time: 12:11 AM
 */

namespace App\Services;
use App\Street;
use Illuminate\Support\Facades\DB;

class StreetService
{
    public function getList()
    {
        $list = Street::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('street')->select('id', 'name')->get();
        return $data;
    }

    public function getStreetByWard($wardId)
    {
        $streets = Street::where('ward_id', $wardId)->select('id', 'name')->get();
        return $streets;
    }
}