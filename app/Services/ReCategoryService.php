<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\ReCategory;
use Illuminate\Support\Facades\DB;

class ReCategoryService
{
    public function getList()
    {
        $list = ReCategory::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('re_categories')->select('id', 'name')->get();
        return $data;
    }

    public function listByInputToken($input)
    {
        $string = $input['term'];
        \Log::info($string);
        $data = ReCategory::where('name', 'LIKE', '%'.$string.'%')->select('id', 'name')->get();
//        $data = ReCategory::get();
        \Log::info($data);
        $result =   [];
        foreach($data as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return $result;
    }

    public function store($input)
    {
        $reCategory = new ReCategory([
            'name' => $input['name'],
            'description' => $input['description']
        ]);
        
        if($reCategory->save()) {
            return $reCategory;
        } else {
            return false;
        }
    }
}