<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\Block;
use Illuminate\Support\Facades\DB;

class BlockService
{
    public function getList()
    {
        $list = Block::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('blocks')->select('id', 'name')->get();
        return $data;
    }

    public function store($input)
    {
        $reCategory = new Block();
        $reCategory->name = $input['name'];
        $reCategory->description = $input['description'];
        if($reCategory->save()) {
            return $reCategory;
        } else {
            return false;
        }
    }
}