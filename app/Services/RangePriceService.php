<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\RangePrice;
use App\ReCategory;
use Illuminate\Support\Facades\DB;

class RangePriceService
{
    public function getList()
    {
        $list = RangePrice::all();
        return $list;
    }

    public function getListDropDown()
    {
        $result = RangePrice::select('id', 'name')->whereNull('deleted_at')->get();
        return $result;
    }

    public function getRangePriceByCat($catId)
    {
        $result = [];
        $reCategory = ReCategory::find($catId);
        if ($reCategory) {
            $result = $reCategory->rangePrices()->select('id', 'name')->get();
        }
        return $result;
    }

    public function store($input)
    {
        $rangePrice = new RangePrice([
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        $reCatId = [];
        if ($input['category']) {
            $reCatId = explode( ',', $input['category']);
        }

        if($rangePrice->save()) {
            if ($reCatId) {
                $rangePrice->reCategories()->attach($reCatId);
            }
            return $rangePrice;
        } else {
            return false;
        }
    }
}
