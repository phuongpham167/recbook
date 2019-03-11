<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\Direction;
use Illuminate\Support\Facades\DB;

class DirectionService
{
    public function getList()
    {
        $list = Direction::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('directions')->select('id', 'name')->whereNull('deleted_at')->get();
        return $data;
    }

    public function store($input)
    {
        $direction = new Direction();
        $direction->name = $input['name'];
        $direction->description = $input['description'];
        if($direction->save()) {
            return $direction;
        } else {
            return false;
        }
    }
}