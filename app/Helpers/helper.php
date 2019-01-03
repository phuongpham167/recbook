<?php

use App\WebsiteConfig;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/9/2018
 * Time: 11:25 AM
 */
function get_web_id () {
    if(!empty($web = \App\Web::where('website',request()->getHttpHost())->first()))
        return $web->id;
    return 1;
}

function a($url, $get='', $name='',$attr=[], $realurl='',$callback=''){
//    if(p($url,'get')){
        $attrs  =   '';
        foreach($attr as $k=>$i){
            $attrs.=    "$k='$i'";
        }
        if(!empty($realurl)){
            $url    =   $realurl;
            $get    =   '';
        }
        else $get   =   '?'.$get;
        return "<a href='".asset($url)."$get' $attrs onclick=\"$callback\">".(!empty($name)?$name:$url)."</a>";
//    }
}
function v($view = null, $data = [], $mergeData = [])
{
    return view('themes.'.theme().'.'.$view, $data, $mergeData);
}

function theme($type=FALSE){
    $prefix =   $type==TRUE?'themes.':'';
    return $prefix.settings('theme','default');
}

function event_log($action) {
    $data = new \App\AccessHistory();
    if(!auth()->check()) {
        $data->id = null;
    }
    else
        $data->user_id = auth()->user()->id;

    $data->ip = request()->ip();
    $data->action = $action;
    $data->created_at = \Carbon\Carbon::now();
    $data->save();
}

function set_notice($message, $type='warning'){
    \Illuminate\Support\Facades\Session::flash('message.type',$type);
    \Illuminate\Support\Facades\Session::flash('message.message',$message);
}

function p($permission, $method='get'){
    $per    =   new App\Permission();
    $per    =   $per->where('permission',$permission)->where('method',$method)->first();
    if(!empty($per) && ( $per->type=='public' || $per->group()->where('group_permission.group_id',auth()->user()->group_id)->count()))
        return TRUE;
    else
        return FALSE;
}

function calc_money ($time) {
    $thu = \App\Receipt::where('time','<=',\Carbon\Carbon::createFromFormat('d/m/Y', $time))->where('type','thu')->where('account_id',request('id'))->sum('value');

    $chi = \App\Receipt::where('time','<=',\Carbon\Carbon::createFromFormat('d/m/Y', $time))->where('type','chi')->where('account_id',request('id'))->sum('value');

    return [
        'thu' => $thu,
        'chi' => $chi,
        'sum' => $thu - $chi
    ];
}

function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    $str = preg_replace('/(^-+)/', '', $str);
    $str = preg_replace('/(-+$)/', '', $str);
    return $str;
}

function checkNeedApprove()
{
    $web_id = get_web_id();
    $webConfig = WebsiteConfig::where('web_id', $web_id)->first();
    if ($webConfig && $webConfig->need_approve) {
        return 1;
    }
    return 0;
}
function transaction_log($reason, $value, $type) {
    $data = new \App\TransactionLog();
    if(!auth()->check()) {
        $data->id = null;
    }
    else
        $data->user_id = auth()->user()->id;

    $data->reason = $reason;
    $data->type = $type;
    $data->value = $value;
    $data->currency = \App\Currency::where('default',1)->first()->id;
    $data->created_at = \Carbon\Carbon::now();
    $data->save();
}

function text_limit($str,$limit=20)
{
    if(stripos($str," ")){
        $ex_str = explode(" ",$str);
        if(count($ex_str)>$limit){
            $str_s = null;
            for($i=0;$i<$limit;$i++){
                $str_s.=$ex_str[$i]." ";
            }
            return $str_s;
        }else{
            return $str;
        }
    }else{
        return $str;
    }
}
