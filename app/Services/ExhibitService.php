<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 9/19/2018
 * Time: 12:31 AM
 */

namespace App\Services;
use App\Exhibit;
use Illuminate\Support\Facades\DB;

class ExhibitService
{
    public function getList()
    {
        $list = Exhibit::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('exhibits')->select('id', 'name')->get();
        return $data;
    }

    public function store($input)
    {
        $exhibit = new Exhibit();
        $exhibit->name = $input['name'];
        $exhibit->description = $input['description'];
        if($exhibit->save()) {
            return $exhibit;
        } else {
            return false;
        }
    }
}