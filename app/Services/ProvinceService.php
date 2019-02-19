<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/30/2018
 * Time: 12:45 AM
 */

namespace App\Services;
use App\Province;
use Illuminate\Support\Collection;
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

    public function getListOrderByWishList()
    {
        if(auth()->check()){
            $userProvinceId = auth()->user()->userinfo->province_id;
            $userProvince = Province::select('id', 'name')->where('id', $userProvinceId)->get();

            $wishListId = auth()->check()?explode(',',session('tinhthanhquantam')):[];
            $wishListIdF = array_diff($wishListId, [$userProvinceId]);
            $wishList = Province::select('id', 'name')->whereIn('id', $wishListIdF)->get();

            $result = $userProvince->merge($wishList);
        }
        else
            $result =   Province::orderBy('order', 'ASC')->get();
        return $result;
    }
}
