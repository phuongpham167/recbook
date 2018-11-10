<?php
/**
 * Created by PhpStorm.
 * User: PhamThang
 * Date: 10/10/2018
 * Time: 1:09 AM
 */

namespace App\Services;

// class real estate service
use App\ReSource;
use Illuminate\Support\Facades\DB;

class ReSourceService
{
    public function getList()
    {
        $list = ReSource::all();
        return $list;
    }

    public function getListDropDown()
    {
        $data = DB::table('re_sources')->select('id', 'name')->get();
        return $data;
    }

    public function store($input)
    {
        $reSource = new ReSource([
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        if($reSource->save()) {
            return $reSource;
        } else {
            return false;
        }
    }
}