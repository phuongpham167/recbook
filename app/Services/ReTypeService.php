<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/26/2018
 * Time: 12:12 AM
 */

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\ReType;
use App\ReCategory;

class ReTypeService
{
    public function getList()
    {
        $list = ReType::all();
        return $list;
    }

    public function getListDropDownNoCat()
    {
        $result = ReType::all();
        return $result;
    }

    public function getListDropDown($catId)
    {
        \Log::info($catId);
        $result = [];
        $reCategory = ReCategory::find($catId);
        if ($reCategory) {
            $result = $reCategory->reTypes()->select('id', 'name')->get();
        }
        return $result;
    }

    public function getReTypeByCat($catId)
    {
        $result = [];
        $reCategory = ReCategory::find($catId);
        if ($reCategory) {
            $result = $reCategory->reTypes()->select('id', 'name')->get();
        }
        return $result;
    }

    public function store($input)
    {
        $reType = new ReType([
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        $reCatId = [];
        if ($input['category']) {
            $reCatId = explode( ',', $input['category']);
        }

        if($reType->save()) {
            if ($reCatId) {
                $reType->reCategories()->attach($reCatId);
            }
            return $reType;
        } else {
            return false;
        }
    }
}
