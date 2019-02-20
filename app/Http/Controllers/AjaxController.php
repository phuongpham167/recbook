<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRoutelist()
    {
        $addition   =   !empty(request('type',''))?request('type','').'/':'';
        $hideinfo =   request('hideinfo', 0);
        $data   =   \Route::getRoutes();
        $result =   [];
        $string = request()->input('term');
        $method =   request('method','');
        foreach($data as $item){
            if(strstr($item->uri, $addition.$string) &&($method=='' || strtolower($item->methods()[0])==$method)) {
                $result[] = [
                    'id' => $item->uri,
                    'name' => $hideinfo==0?$item->methods()[0].'- '.$item->uri:$item->uri,
                    'method'    => strtolower($item->methods()[0])
                ];
            }
        }
        $result[]   =   [
            'id'    =>  $string,
            'name'  =>  trans('permissions.spec').': '.$string,
            'method'    =>  'get'
        ];
        return response()->json($result);
    }

    public function ajaxUser() {
        $name   = request()->input('term');
        $result =   [];
        foreach(\App\User::where('name','LIKE',"%{$name}%")->where('web_id',get_web_id())->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name.' - '.$item->email
            ];
        }
        return response()->json($result);
    }

    public function ajaxAccount() {
        $name   = request()->input('term');
        $result =   [];
        foreach(\App\Account::where('name','LIKE',"%{$name}%")->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name,
                'icon'  =>  Currency::where('id',$item->currency_id)->first()->icon
            ];
        }
        return response()->json($result);
    }

    public function ajaxWebsite() {
        $name   = request()->input('term');
        $result =   [];
        foreach(\App\Web::where('name','LIKE',"%{$name}%")->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return response()->json($result);
    }

    public function ajaxStreet() {
        $name   = request()->input('term');
        $province_id   = request('province_id');
        $district_id   = request('district_id');
        $ward_id   = request('ward_id');
        $result =   [];
        $result[]   =   [
            'id'    =>  ucwords($name),
            'name'  =>  trans('area.new_street').': '.ucwords($name)
        ];
        foreach(\App\Street::where('name','LIKE',"%{$name}%")->where('province_id',$province_id)->where('district_id',$district_id)->where('ward_id',$ward_id)->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return response()->json($result);
    }
    public function ajaxProject() {
        $name   = request()->input('term');
        $province_id   = request('province_id');
        $addnew = request('addnew', 1);
        $result =   [];
        if($addnew==1){
            $result[]   =   [
                'id'    =>  ucwords($name),
                'name'  =>  trans('area.new_project').': '.ucwords($name)
            ];
        }
        foreach(\App\Project::where('name','LIKE',"%{$name}%")->where('province_id',$province_id)->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return response()->json($result);
    }
    public function ajaxProvince(){
        $name   = request()->input('term');
        $result =   [];
        foreach(\App\Province::where('name','LIKE',"%{$name}%")->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return response()->json($result);
    }

    public function ajaxCustomer() {
        $name   = request()->input('term');
        $result =   [];
        foreach(\App\Customer::where('name','LIKE',"%{$name}%")->where('web_id',get_web_id())->where('user_id',auth()->user()->id)->get() as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name.' - '.$item->email
            ];
        }
        return response()->json($result);
    }
}
