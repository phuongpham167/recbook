<?php
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