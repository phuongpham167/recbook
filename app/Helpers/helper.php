<?php

use App\Friend;
use App\Menu;
use App\RealEstate;
use App\ShowingCfg;
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

function isFriend($id1, $id2)
{
    $checkFriend1 = Friend::where('user1', $id1)->where('user2', $id2)->count();
    $checkFriend2 = Friend::where('user1', $id2)->where('user2', $id1)->count();

    if ($checkFriend1 != 0 || $checkFriend2 != 0) {
        return true;
    }
    return false;
}

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
function frontendweb_create($web_id, $template, $name, $user_id=null){
//    if($user_id==null) $user_id =   auth()->user()->id;
    $project_template = array (
        'presets' =>
            array (
                0 =>
                    array (
                        'category' => 'banner',
                        'title' => 'Banner-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/banner-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'banner-01.html',
                    ),
                1 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-01.html',
                    ),
                2 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-02.html',
                    ),
                3 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-03.html',
                    ),
                4 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-04.html',
                    ),
                5 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-05.html',
                    ),
                6 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-06.html',
                    ),
                7 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-07.html',
                    ),
                8 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-08.html',
                    ),
                9 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-09.html',
                    ),
                10 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-10.html',
                    ),
                11 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-11.html',
                    ),
                12 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-12.html',
                    ),
                13 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-13.html',
                    ),
                14 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-14.html',
                    ),
                15 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-15.html',
                    ),
                16 =>
                    array (
                        'category' => 'navigation',
                        'title' => 'Navigation-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/navigation-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'navigation-16.html',
                    ),
                17 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-01.html',
                    ),
                18 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-02.html',
                    ),
                19 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-03.html',
                    ),
                20 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-04.html',
                    ),
                21 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-05.html',
                    ),
                22 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-06.html',
                    ),
                23 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-07.html',
                    ),
                24 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-08.html',
                    ),
                25 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-09.html',
                    ),
                26 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-10.html',
                    ),
                27 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-11.html',
                    ),
                28 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-12.html',
                    ),
                29 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-13.html',
                    ),
                30 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-14.html',
                    ),
                31 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-15.html',
                    ),
                32 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-16.html',
                    ),
                33 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-17.html',
                    ),
                34 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-18.html',
                    ),
                35 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-19.html',
                    ),
                36 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-20.html',
                    ),
                37 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-21.html',
                    ),
                38 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-22.html',
                    ),
                39 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-23.html',
                    ),
                40 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-24.html',
                    ),
                41 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-25.html',
                    ),
                42 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-26.html',
                    ),
                43 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-27.html',
                    ),
                44 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-28.html',
                    ),
                45 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-29',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-29.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-29.html',
                    ),
                46 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-30',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-30.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-30.html',
                    ),
                47 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-31',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-31.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-31.html',
                    ),
                48 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-32',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-32.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-32.html',
                    ),
                49 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-33',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-33.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-33.html',
                    ),
                50 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-34',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-34.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-34.html',
                    ),
                51 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-35',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-35.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-35.html',
                    ),
                52 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-36',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-36.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-36.html',
                    ),
                53 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-37',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-37.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-37.html',
                    ),
                54 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-38',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-38.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-38.html',
                    ),
                55 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-39',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-39.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-39.html',
                    ),
                56 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-40',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-40.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-40.html',
                    ),
                57 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-41',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-41.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-41.html',
                    ),
                58 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-42',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-42.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-42.html',
                    ),
                59 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-43',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-43.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-43.html',
                    ),
                60 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-44',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-44.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-44.html',
                    ),
                61 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-45',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-45.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-45.html',
                    ),
                62 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-46',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-46.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-46.html',
                    ),
                63 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-47',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-47.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-47.html',
                    ),
                64 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-48',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-48.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-48.html',
                    ),
                65 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-49',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-49.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-49.html',
                    ),
                66 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-50',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-50.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-50.html',
                    ),
                67 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-51',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-51.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-51.html',
                    ),
                68 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-52',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-52.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-52.html',
                    ),
                69 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-53',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-53.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-53.html',
                    ),
                70 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-54',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-54.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-54.html',
                    ),
                71 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-55',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-55.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-55.html',
                    ),
                72 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-56',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-56.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-56.html',
                    ),
                73 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-57',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-57.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-57.html',
                    ),
                74 =>
                    array (
                        'category' => 'intro',
                        'title' => 'Intro-58',
                        'reload' => true,
                        'preview' => 'elements/blocks/intro-58.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'intro-58.html',
                    ),
                75 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-01',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-01.html',
                        'categories' =>
                            array (
                            ),
                    ),
                76 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-02',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-02.html',
                    ),
                77 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-03',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-03.html',
                    ),
                78 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-04',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-04.html',
                    ),
                79 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-05',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-05.html',
                    ),
                80 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-06',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-06.html',
                    ),
                81 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-07',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-07.html',
                    ),
                82 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-08',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-08.html',
                    ),
                83 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-09',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-09.html',
                    ),
                84 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-10',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-10.html',
                    ),
                85 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-11',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-11.html',
                    ),
                86 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-12',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-12.html',
                    ),
                87 =>
                    array (
                        'category' => 'Call to action',
                        'title' => 'Call to action-13',
                        'reload' => true,
                        'preview' => 'elements/call-to-action-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'call-to-action-13.html',
                    ),
                88 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-01.html',
                    ),
                89 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-02.html',
                    ),
                90 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-03.html',
                    ),
                91 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-04.html',
                    ),
                92 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-05.html',
                    ),
                93 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-06.html',
                    ),
                94 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-07.html',
                    ),
                95 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-08.html',
                    ),
                96 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-09.html',
                    ),
                97 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-10.html',
                    ),
                98 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-11.html',
                    ),
                99 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-12.html',
                    ),
                100 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-13.html',
                    ),
                101 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-14.html',
                    ),
                102 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-15.html',
                    ),
                103 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-16.html',
                    ),
                104 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-17.html',
                    ),
                105 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-18.html',
                    ),
                106 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-19.html',
                    ),
                107 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-20.html',
                    ),
                108 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-21.html',
                    ),
                109 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-22.html',
                    ),
                110 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-23.html',
                    ),
                111 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-24.html',
                    ),
                112 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-25.html',
                    ),
                113 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-26.html',
                    ),
                114 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-27.html',
                    ),
                115 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-28.html',
                    ),
                116 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-29',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-29.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-29.html',
                    ),
                117 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-30',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-30.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-30.html',
                    ),
                118 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-31',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-31.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-31.html',
                    ),
                119 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-32',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-32.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-32.html',
                    ),
                120 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-33',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-33.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-33.html',
                    ),
                121 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-34',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-34.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-34.html',
                    ),
                122 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-35',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-35.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-35.html',
                    ),
                123 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-36',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-36.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-36.html',
                    ),
                124 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-37',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-37.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-37.html',
                    ),
                125 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-38',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-38.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-38.html',
                    ),
                126 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-39',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-39.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-39.html',
                    ),
                127 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-40',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-40.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-40.html',
                    ),
                128 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-41',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-41.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-41.html',
                    ),
                129 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-42',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-42.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-42.html',
                    ),
                130 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-43',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-43.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-43.html',
                    ),
                131 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-44',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-44.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-44.html',
                    ),
                132 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-45',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-45.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-45.html',
                    ),
                133 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-46',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-46.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-46.html',
                    ),
                134 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-47',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-47.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-47.html',
                    ),
                135 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-48',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-48.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-48.html',
                    ),
                136 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-49',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-49.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-49.html',
                    ),
                137 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-50',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-50.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-50.html',
                    ),
                138 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-51',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-51.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-51.html',
                    ),
                139 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-52',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-52.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-52.html',
                    ),
                140 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-53',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-53.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-53.html',
                    ),
                141 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-54',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-54.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-54.html',
                    ),
                142 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-55',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-55.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-55.html',
                    ),
                143 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-56',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-56.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-56.html',
                    ),
                144 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-57',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-57.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-57.html',
                    ),
                145 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-58',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-58.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-58.html',
                    ),
                146 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-59',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-59.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-59.html',
                    ),
                147 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-60',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-60.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-60.html',
                    ),
                148 =>
                    array (
                        'category' => 'Content',
                        'title' => 'Content-61',
                        'reload' => true,
                        'preview' => 'elements/blocks/content-61.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'content-61.html',
                    ),
                149 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-01.html',
                    ),
                150 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-02.html',
                    ),
                151 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-03.html',
                    ),
                152 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-04.html',
                    ),
                153 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-05.html',
                    ),
                154 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-06.html',
                    ),
                155 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-07.html',
                    ),
                156 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-08.html',
                    ),
                157 =>
                    array (
                        'category' => 'Counter',
                        'title' => 'Counter-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/counter-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'counter-09.html',
                    ),
                158 =>
                    array (
                        'category' => 'Download',
                        'title' => 'Download-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/download-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'download-01.html',
                    ),
                159 =>
                    array (
                        'category' => 'Download',
                        'title' => 'Download-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/download-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'download-02.html',
                    ),
                160 =>
                    array (
                        'category' => 'Download',
                        'title' => 'Download-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/download-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'download-03.html',
                    ),
                161 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-01.html',
                    ),
                162 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-02.html',
                    ),
                163 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-03.html',
                    ),
                164 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-04.html',
                    ),
                165 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-05.html',
                    ),
                166 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-06.html',
                    ),
                167 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-07.html',
                    ),
                168 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-08.html',
                    ),
                169 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-09.html',
                    ),
                170 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-10.html',
                    ),
                171 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-11.html',
                    ),
                172 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-12.html',
                    ),
                173 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-13.html',
                    ),
                174 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-14.html',
                    ),
                175 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-15.html',
                    ),
                176 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-16.html',
                    ),
                177 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-17.html',
                    ),
                178 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-18.html',
                    ),
                179 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-19.html',
                    ),
                180 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-20.html',
                    ),
                181 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-21.html',
                    ),
                182 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-22.html',
                    ),
                183 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-23.html',
                    ),
                184 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-24.html',
                    ),
                185 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-25.html',
                    ),
                186 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-26.html',
                    ),
                187 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-27.html',
                    ),
                188 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-28.html',
                    ),
                189 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-29',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-29.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-29.html',
                    ),
                190 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-30',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-30.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-30.html',
                    ),
                191 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-31',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-31.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-31.html',
                    ),
                192 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-32',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-32.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-32.html',
                    ),
                193 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-33',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-33.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-33.html',
                    ),
                194 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-34',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-34.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-34.html',
                    ),
                195 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-35',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-35.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-35.html',
                    ),
                196 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-36',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-36.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-36.html',
                    ),
                197 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-37',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-37.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-37.html',
                    ),
                198 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-38',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-38.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-38.html',
                    ),
                199 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-39',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-39.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-39.html',
                    ),
                200 =>
                    array (
                        'category' => 'Features',
                        'title' => 'Features-40',
                        'reload' => true,
                        'preview' => 'elements/blocks/features-40.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'features-40.html',
                    ),
                201 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-01.html',
                    ),
                202 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-02.html',
                    ),
                203 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-03.html',
                    ),
                204 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-04.html',
                    ),
                205 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-05.html',
                    ),
                206 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-06.html',
                    ),
                207 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-07.html',
                    ),
                208 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-08.html',
                    ),
                209 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-09.html',
                    ),
                210 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-10.html',
                    ),
                211 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-11.html',
                    ),
                212 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-12.html',
                    ),
                213 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-13.html',
                    ),
                214 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-14.html',
                    ),
                215 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-15.html',
                    ),
                216 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-16.html',
                    ),
                217 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-17.html',
                    ),
                218 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-18.html',
                    ),
                219 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-19.html',
                    ),
                220 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-20.html',
                    ),
                221 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-21.html',
                    ),
                222 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-22.html',
                    ),
                223 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-23.html',
                    ),
                224 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-24.html',
                    ),
                225 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-25.html',
                    ),
                226 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-26.html',
                    ),
                227 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-27.html',
                    ),
                228 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-28.html',
                    ),
                229 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-29',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-29.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-29.html',
                    ),
                230 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-30',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-30.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-30.html',
                    ),
                231 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-31',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-31.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-31.html',
                    ),
                232 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-32',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-32.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-32.html',
                    ),
                233 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-33',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-33.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-33.html',
                    ),
                234 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-34',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-34.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-34.html',
                    ),
                235 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-35',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-35.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-35.html',
                    ),
                236 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-36',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-36.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-36.html',
                    ),
                237 =>
                    array (
                        'category' => 'Footer',
                        'title' => 'Footer-37',
                        'reload' => true,
                        'preview' => 'elements/blocks/footer-37.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'footer-37.html',
                    ),
                238 =>
                    array (
                        'category' => 'Social',
                        'title' => 'Social-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/social-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'social-01.html',
                    ),
                239 =>
                    array (
                        'category' => 'Social',
                        'title' => 'Social-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/social-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'social-02.html',
                    ),
                240 =>
                    array (
                        'category' => 'Social',
                        'title' => 'Social-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/social-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'social-03.html',
                    ),
                241 =>
                    array (
                        'category' => 'Social',
                        'title' => 'Social-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/social-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'social-04.html',
                    ),
                242 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-01.html',
                    ),
                243 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-02.html',
                    ),
                244 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-03.html',
                    ),
                245 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-04.html',
                    ),
                246 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-05.html',
                    ),
                247 =>
                    array (
                        'category' => 'Form',
                        'title' => 'Form-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/form-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'form-06.html',
                    ),
                248 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-01.html',
                    ),
                249 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-02.html',
                    ),
                250 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-03.html',
                    ),
                251 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-04.html',
                    ),
                252 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-05.html',
                    ),
                253 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-06.html',
                    ),
                254 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-07.html',
                    ),
                255 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-08.html',
                    ),
                256 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-09.html',
                    ),
                257 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-10.html',
                    ),
                258 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-11.html',
                    ),
                259 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-12.html',
                    ),
                260 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-13.html',
                    ),
                261 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-14.html',
                    ),
                262 =>
                    array (
                        'category' => 'Logos',
                        'title' => 'Logos-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/logos-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'logos-15.html',
                    ),
                263 =>
                    array (
                        'category' => 'Map',
                        'title' => 'Map-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/map-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'map-01.html',
                    ),
                264 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-01.html',
                    ),
                265 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-02.html',
                    ),
                266 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-03.html',
                    ),
                267 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-04.html',
                    ),
                268 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-05.html',
                    ),
                269 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-06.html',
                    ),
                270 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-07.html',
                    ),
                271 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-08.html',
                    ),
                272 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-09.html',
                    ),
                273 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-10.html',
                    ),
                274 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-11.html',
                    ),
                275 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-12.html',
                    ),
                276 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-13.html',
                    ),
                277 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-14.html',
                    ),
                278 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-15.html',
                    ),
                279 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-16.html',
                    ),
                280 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-17.html',
                    ),
                281 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-18.html',
                    ),
                282 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-19.html',
                    ),
                283 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-20.html',
                    ),
                284 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-21.html',
                    ),
                285 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-22.html',
                    ),
                286 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-23.html',
                    ),
                287 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-24.html',
                    ),
                288 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-25.html',
                    ),
                289 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-26.html',
                    ),
                290 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-27.html',
                    ),
                291 =>
                    array (
                        'category' => 'Other sections',
                        'title' => 'Other-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/other-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'other-28.html',
                    ),
                292 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-01.html',
                    ),
                293 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-02.html',
                    ),
                294 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-03.html',
                    ),
                295 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-04.html',
                    ),
                296 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-05.html',
                    ),
                297 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-06.html',
                    ),
                298 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-07.html',
                    ),
                299 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-08.html',
                    ),
                300 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-09.html',
                    ),
                301 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-10.html',
                    ),
                302 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-11.html',
                    ),
                303 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-12.html',
                    ),
                304 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-13.html',
                    ),
                305 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-14.html',
                    ),
                306 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-15.html',
                    ),
                307 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-16.html',
                    ),
                308 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-17.html',
                    ),
                309 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-18.html',
                    ),
                310 =>
                    array (
                        'category' => 'Popup',
                        'title' => 'Popup-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/popup-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'popup-19.html',
                    ),
                311 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-01.html',
                    ),
                312 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-02.html',
                    ),
                313 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-03.html',
                    ),
                314 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-04.html',
                    ),
                315 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-05.html',
                    ),
                316 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-06.html',
                    ),
                317 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-07.html',
                    ),
                318 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-08.html',
                    ),
                319 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-09.html',
                    ),
                320 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-10.html',
                    ),
                321 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-11.html',
                    ),
                322 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-12.html',
                    ),
                323 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-13.html',
                    ),
                324 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-14.html',
                    ),
                325 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-15.html',
                    ),
                326 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-16.html',
                    ),
                327 =>
                    array (
                        'category' => 'Portfolio & Gallery',
                        'title' => 'Portfolio-gallery-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/portfolio-gallery-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'portfolio-gallery-17.html',
                    ),
                328 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-01.html',
                    ),
                329 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-02.html',
                    ),
                330 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-03.html',
                    ),
                331 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-04.html',
                    ),
                332 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-05.html',
                    ),
                333 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-06.html',
                    ),
                334 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-07.html',
                    ),
                335 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-08.html',
                    ),
                336 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-09.html',
                    ),
                337 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-10.html',
                    ),
                338 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-11.html',
                    ),
                339 =>
                    array (
                        'category' => 'Price',
                        'title' => 'Price-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/price-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'price-12.html',
                    ),
                340 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-01.html',
                    ),
                341 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-02.html',
                    ),
                342 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-03.html',
                    ),
                343 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-04.html',
                    ),
                344 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-05.html',
                    ),
                345 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-06.html',
                    ),
                346 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-07.html',
                    ),
                347 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-08.html',
                    ),
                348 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-09.html',
                    ),
                349 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-10.html',
                    ),
                350 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-11.html',
                    ),
                351 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-12.html',
                    ),
                352 =>
                    array (
                        'category' => 'Products',
                        'title' => 'Products-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/products-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'products-13.html',
                    ),
                353 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-01.html',
                    ),
                354 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-02.html',
                    ),
                355 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-03.html',
                    ),
                356 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-04.html',
                    ),
                357 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-05.html',
                    ),
                358 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-06.html',
                    ),
                359 =>
                    array (
                        'category' => 'Slider',
                        'title' => 'Slider-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/slider-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'slider-07.html',
                    ),
                360 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-01.html',
                    ),
                361 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-02.html',
                    ),
                362 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-03.html',
                    ),
                363 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-04.html',
                    ),
                364 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-05.html',
                    ),
                365 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-06.html',
                    ),
                366 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-07.html',
                    ),
                367 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-08.html',
                    ),
                368 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-09.html',
                    ),
                369 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-10.html',
                    ),
                370 =>
                    array (
                        'category' => 'Subscribe',
                        'title' => 'Subscribe-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/subscribe-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'subscribe-11.html',
                    ),
                371 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-01.html',
                    ),
                372 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-02.html',
                    ),
                373 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-03.html',
                    ),
                374 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-04.html',
                    ),
                375 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-05.html',
                    ),
                376 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-06.html',
                    ),
                377 =>
                    array (
                        'category' => 'Team',
                        'title' => 'Team-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/team-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'team-07.html',
                    ),
                378 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-01.html',
                    ),
                379 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-02.html',
                    ),
                380 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-03.html',
                    ),
                381 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-04.html',
                    ),
                382 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-05.html',
                    ),
                383 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-06.html',
                    ),
                384 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-07.html',
                    ),
                385 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-08.html',
                    ),
                386 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-09.html',
                    ),
                387 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-10.html',
                    ),
                388 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-11.html',
                    ),
                389 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-12.html',
                    ),
                390 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-13.html',
                    ),
                391 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-14',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-14.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-14.html',
                    ),
                392 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-15',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-15.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-15.html',
                    ),
                393 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-16',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-16.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-16.html',
                    ),
                394 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-17',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-17.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-17.html',
                    ),
                395 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-18',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-18.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-18.html',
                    ),
                396 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-19',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-19.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-19.html',
                    ),
                397 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-20',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-20.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-20.html',
                    ),
                398 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-21',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-21.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-21.html',
                    ),
                399 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-22',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-22.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-22.html',
                    ),
                400 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-23',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-23.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-23.html',
                    ),
                401 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-24',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-24.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-24.html',
                    ),
                402 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-25',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-25.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-25.html',
                    ),
                403 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-26',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-26.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-26.html',
                    ),
                404 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-27',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-27.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-27.html',
                    ),
                405 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-28',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-28.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-28.html',
                    ),
                406 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-29',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-29.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-29.html',
                    ),
                407 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-30',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-30.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-30.html',
                    ),
                408 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-31',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-31.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-31.html',
                    ),
                409 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-32',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-32.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-32.html',
                    ),
                410 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-33',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-33.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-33.html',
                    ),
                411 =>
                    array (
                        'category' => 'Testimonials',
                        'title' => 'Testimonials-34',
                        'reload' => true,
                        'preview' => 'elements/blocks/testimonials-34.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'testimonials-34.html',
                    ),
                412 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-01',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-01.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-01.html',
                    ),
                413 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-02',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-02.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-02.html',
                    ),
                414 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-03',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-03.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-03.html',
                    ),
                415 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-04',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-04.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-04.html',
                    ),
                416 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-05',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-05.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-05.html',
                    ),
                417 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-06',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-06.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-06.html',
                    ),
                418 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-07',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-07.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-07.html',
                    ),
                419 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-08',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-08.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-08.html',
                    ),
                420 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-09',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-09.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-09.html',
                    ),
                421 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-10',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-10.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-10.html',
                    ),
                422 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-11',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-11.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-11.html',
                    ),
                423 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-12',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-12.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-12.html',
                    ),
                424 =>
                    array (
                        'category' => 'Video',
                        'title' => 'Video-13',
                        'reload' => true,
                        'preview' => 'elements/blocks/video-13.jpg',
                        'canBeInsertedTo' => '#page',
                        'path' => 'video-13.html',
                    ),
                425 =>
                    array (
                        'category' => 'Google reCaptcha',
                        'title' => 'Google reCaptcha',
                        'reload' => true,
                        'preview' => 'elements/google-recaptcha.jpg',
                        'canBeInsertedTo' => '.field-wrp',
                        'path' => 'google-recaptcha.html',
                    ),
                426 =>
                    array (
                        'category' => 'Policy-popup',
                        'title' => 'Policy-popup',
                        'reload' => true,
                        'preview' => 'elements/policy-popup.jpg',
                        'canBeInsertedTo' => '.field-wrp',
                        'path' => 'policy-popup.html',
                    ),
            ),
        'name' => $name,
        'dir' => 'projects/template/',
        'pages' =>
            array (
                0 =>
                    array (
                        'title' => 'Trang chủ',
                        'index' => true,
                        'isActive' => false,
                        'path' => 'index.html',
                        'preview' => 'index.jpg',
                    )
            ),
        'files' =>
            array (
            ),
        'readOnlyFiles' =>
            array (
            ),
        'publishPath' => 'http://'.(\App\Frontend::find($web_id)?\App\Frontend::find($web_id)->domain:''),
        'disablePublishPromt' => false,
        'layers' =>
            array (
                0 =>
                    array (
                        'name' => 'Section',
                        'element' => 'section',
                        'canBeInsertedTo' => '#page',
                    ),
                1 =>
                    array (
                        'name' => 'Section',
                        'element' => '.section',
                        'canBeInsertedTo' => '#page',
                    ),
                2 =>
                    array (
                        'name' => 'Main header',
                        'element' => '.main-head',
                        'canBeInsertedTo' => '#page',
                    ),
                3 =>
                    array (
                        'name' => 'Main footer',
                        'element' => '.main-footer',
                        'canBeInsertedTo' => '#page',
                    ),
                4 =>
                    array (
                        'name' => 'Column',
                        'element' => '[class*=col-]',
                        'canBeInsertedTo' => '.row',
                    ),
                5 =>
                    array (
                        'name' => 'Equal column',
                        'element' => '.cl',
                        'canBeInsertedTo' => '.rw',
                    ),
                6 =>
                    array (
                        'name' => 'info-obj',
                        'element' => '.info-obj',
                        'canBeInsertedTo' => '[class*="col-"]',
                    ),
                7 =>
                    array (
                        'name' => 'form-block',
                        'element' => '.form-block',
                        'canBeInsertedTo' => '[class*="col-"]',
                    ),
                8 =>
                    array (
                        'name' => 'form-group',
                        'element' => '.form-group',
                        'canBeInsertedTo' => '.field-wrp',
                    ),
                9 =>
                    array (
                        'name' => 'Menu item',
                        'element' => '.menu-item',
                        'canBeInsertedTo' => '.menu',
                    ),
                10 =>
                    array (
                        'name' => 'form-group',
                        'element' => '.form-group',
                        'canBeInsertedTo' => '.field-wrp',
                    ),
                11 =>
                    array (
                        'name' => 'form-group',
                        'element' => '.form-group',
                        'canBeInsertedTo' => '[class*="col-"]',
                    ),
                12 =>
                    array (
                        'name' => 'inline-list column',
                        'element' => '.inline-list>li',
                        'canBeInsertedTo' => '.inline-list',
                    ),
                13 =>
                    array (
                        'name' => 'info box content',
                        'element' => '.info-obj .info > *',
                        'canBeInsertedTo' => '.info-obj .info',
                    ),
                14 =>
                    array (
                        'name' => 'Info box icons',
                        'element' => '.info-obj .iconwrp [class*="pe-"]',
                        'canBeInsertedTo' => '.info-obj .iconwrp',
                    ),
                15 =>
                    array (
                        'name' => 'Info box icons',
                        'element' => '.info-obj .iconwrp [class*="fa-"]',
                        'canBeInsertedTo' => '.info-obj .iconwrp',
                    ),
                16 =>
                    array (
                        'name' => 'Footer',
                        'element' => 'footer',
                        'canBeInsertedTo' => '#page',
                    ),
                17 =>
                    array (
                        'name' => 'Pop-up',
                        'element' => '.popup-content',
                        'canBeInsertedTo' => '#page',
                    ),
                18 =>
                    array (
                        'name' => 'BG holder',
                        'element' => '[class*="col-"] > .bg-holder',
                        'canBeInsertedTo' => '[class*="col-"]',
                    ),
            ),
        'iconFonts' =>
            array (
                0 =>
                    array (
                        'family' => 'et-line',
                        'default' => false,
                    ),
            ),
        'plugins' =>
            array (
                0 =>
                    array (
                        'name' => 'novi-plugin-background-image',
                        'settings' =>
                            array (
                                'querySelector' => '[class*="custom-bg-image"]',
                                'childQuerySelector' => '[class*="custom-bg-image-image"]',
                            ),
                    ),
                1 =>
                    array (
                        'name' => 'novi-plugin-background',
                        'settings' =>
                            array (
                                'querySelector' => '.novi-background, .overlay, .main-head, section[class*="bg-"]',
                            ),
                    ),
                2 =>
                    array (
                        'name' => 'novi-plugin-camera-slider',
                        'settings' =>
                            array (
                                'querySelector' => '.camera_wrap',
                            ),
                    ),
                3 =>
                    array (
                        'name' => 'novi-plugin-google-map',
                        'settings' =>
                            array (
                                'querySelector' => '.google-map-container',
                            ),
                    ),
                4 =>
                    array (
                        'name' => 'novi-plugin-icon-manager',
                        'settings' =>
                            array (
                                'querySelector' => '.novi-icon, [class*="fa-"], [class*="icon-"], [class*="pe-7s-"]',
                            ),
                    ),
                5 =>
                    array (
                        'name' => 'novi-plugin-iframe',
                        'settings' =>
                            array (
                                'querySelector' => 'iframe[src]',
                            ),
                    ),
                6 =>
                    array (
                        'name' => 'novi-plugin-image',
                        'settings' =>
                            array (
                                'querySelector' => 'img[src]',
                            ),
                    ),
                7 =>
                    array (
                        'name' => 'novi-plugin-link',
                        'settings' =>
                            array (
                                'querySelector' => 'a[href]',
                                'favoriteLinks' =>
                                    array (
                                        0 =>
                                            array (
                                                'title' => '',
                                                'value' => '',
                                            ),
                                    ),
                                'applyToProjectElements' => true,
                            ),
                    ),
                8 =>
                    array (
                        'name' => 'novi-plugin-material-parallax',
                        'settings' =>
                            array (
                                'querySelector' => '.parallax-container, [data-bgholder="parallax"]',
                            ),
                    ),
                9 =>
                    array (
                        'name' => 'novi-plugin-owl-carousel',
                        'settings' =>
                            array (
                                'querySelector' => '.owl-carousel',
                                'childQuerySelector' => '.owl-carousel .owl-item > *',
                            ),
                    ),
                10 =>
                    array (
                        'name' => 'novi-plugin-swiper-slider',
                        'settings' =>
                            array (
                                'querySelector' => '.swiper-container:not(.gallery-thumbs)',
                                'effects' =>
                                    array (
                                        0 =>
                                            array (
                                                'label' => 'Slide',
                                                'value' => 'slide',
                                                'clearableValue' => false,
                                            ),
                                        1 =>
                                            array (
                                                'label' => 'Fade',
                                                'value' => 'fade',
                                                'clearableValue' => false,
                                            ),
                                    ),
                            ),
                    ),
                11 =>
                    array (
                        'name' => 'rgen-backgroundimage',
                        'settings' =>
                            array (
                                'querySelector' => '.bg-holder',
                                'childQuerySelector' => '.bg-holder > [data-bgholder="bg-img"]',
                            ),
                    ),
                12 =>
                    array (
                        'name' => 'rgen-backgroundparallax',
                        'settings' =>
                            array (
                                'querySelector' => '.bg-holder',
                                'childQuerySelector' => '.bg-holder > [data-bgholder="bg-img"]',
                            ),
                    ),
                13 =>
                    array (
                        'name' => 'rgen-backgroundslider',
                        'settings' =>
                            array (
                                'querySelector' => '.bg-holder',
                                'childQuerySelector' => '.bg-holder > *',
                            ),
                    ),
                14 =>
                    array (
                        'name' => 'rgen-backgroundvideo',
                        'settings' =>
                            array (
                                'querySelector' => '.bg-holder',
                                'childQuerySelector' => '.bg-holder > *',
                            ),
                    ),
                15 =>
                    array (
                        'name' => 'rgen-bgimage',
                        'settings' =>
                            array (
                                'querySelector' => '[data-bg]',
                                'childQuerySelector' => '',
                            ),
                    ),
                16 =>
                    array (
                        'name' => 'rgen-overlay',
                        'settings' =>
                            array (
                                'querySelector' => '.bg-holder',
                                'childQuerySelector' => '.bg-holder > [data-bgholder="overlay"]',
                            ),
                    ),
            ),
        'mediaDir' => 'images/',
        'videoDir' => 'video/',
        'fontDir' => 'fonts/',
        'cssDir' => 'css/',
        'codeEditor' =>
            array (
                'cssFile' => 'lib/bootstrap/css/bootstrap.css',
                'jsFile' => 'js/webfonts.js',
            ),
        'pageContainer' => '#page',
        'mediaLibrary' =>
            array (
                'items' =>
                    array (
                        0 =>
                            array (
                                'original' => 'intro-bg01.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg01.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 0,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        1 =>
                            array (
                                'original' => 'intro-bg02.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg02.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 1,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        2 =>
                            array (
                                'original' => 'intro-bg03.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg03.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 2,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        3 =>
                            array (
                                'original' => 'intro-bg04.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg04.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 3,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        4 =>
                            array (
                                'original' => 'intro-bg05.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg05.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 4,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        5 =>
                            array (
                                'original' => 'intro-bg06.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg06.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 5,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        6 =>
                            array (
                                'original' => 'intro-bg07.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg07.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 6,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        7 =>
                            array (
                                'original' => 'intro-bg08.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg08.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 7,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        8 =>
                            array (
                                'original' => 'intro-bg09.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg09.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 8,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        9 =>
                            array (
                                'original' => 'intro-bg10.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg10.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 9,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                        10 =>
                            array (
                                'original' => 'intro-bg11.jpg',
                                'type' => 'image',
                                'thumbnail' => 'projects/template/novi/media/thumbnails/intro-bg11.jpg',
                                'categories' =>
                                    array (
                                    ),
                                'id' => 10,
                                'width' => 1920,
                                'height' => 1200,
                            ),
                    ),
                'categories' =>
                    array (
                        0 =>
                            array (
                                'name' => 'New Category',
                                'images' => 0,
                                'videos' => 0,
                                'id' => 3,
                            ),
                    ),
            ),
        'basicTemplate' => '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Your Landing Page Title</title>

	<!--pageMeta-->
	

	<!-- Lib CSS -->
	<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="lib/owl-carousel/owl.css" rel="stylesheet">
    <link href="lib/Swiper/css/swiper.min.css" rel="stylesheet">
    <link href="lib/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/vegas/vegas.min.css" rel="stylesheet">
    <link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
    <link href="lib/sweetalert/sweetalert2.min.css" rel="stylesheet">
    <link href="lib/materialize-parallax/materialize-parallax.css" rel="stylesheet">


	<!-- Icon fonts -->
    <link href="fonts/fontawesome-all.min.css" rel="stylesheet">
    <link href="fonts/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="fonts/et-line-font.css" rel="stylesheet">

    <!-- Template CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/rgen-grids.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Theme color css -->
    <link href="css/themes/default.css" rel="stylesheet">
    <link href="css/template-custom.css" rel="stylesheet">

	<!-- Favicons -->
	<link rel="icon" href="images/favicons/favicon.ico">
	<link rel="apple-touch-icon" href="images/favicons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-touch-icon-114x114.png">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--[if IE 9 ]><script src="js/ie-matchmedia.js"></script><![endif]-->

</head>



<body>
<div class="page-loader"><b class="spinner"></b></div>
<div id="page" data-linkscroll=\'y\'>


	<!--
	************************************************************
	* Header
	************************************************************ -->
	<header class="main-head dark bg-dark" data-sticky-scroll="y">
		<div class="container">
			
			<div class="row gt0 align-items-center head-row">
				
				<!--=================================
				= Logo section
				==================================-->
				<div class="col-md-3 pos-rel">
					<a class="nav-handle" data-nav=".m-content" data-navopen="pe-7s-more" data-navclose="pe-7s-close"><i class="pe-7s-more"></i></a>
					<div class="header-logo-wrp">
						<a class="header-logo pd-tb-small" href="http://rgenesis.com"><img src="images/logo-light.png" alt="Brand logo"></a>
					</div>
				</div><!-- // END : Column //  -->
				
				<!--=================================
				= Navigation links
				==================================-->
				<div class="col-md-9 align-r m-content">
					<ul class="row gt20 justify-content-md-end mr-0 align-items-center">
						<li class="col-md-auto">
							<nav class="menu-wrp align-l">
								<ul class="menu">
									<li class="menu-item">
										<a>Home</a>
									</li>
									<li class="menu-item has-dropdown">
										<a>Drop down</a>
										<ul class="sub">
											<li class="has-dropdown">
												<a>About us</a>
												<ul class="dropdown">
													<li><a href="page-aboutus-01.html">About us 01</a></li>
													<li><a href="page-aboutus-02.html">About us 02</a></li>
												</ul>
											</li>
											<li class="has-dropdown">
												<a>Services</a>
												<ul class="dropdown">
													<li><a href="page-services-01.html">Services 01</a></li>
													<li><a href="page-services-02.html">Services 02</a></li>
												</ul>
											</li>
											<li><a href="page-blog-single-01.html">Blog post</a></li>
											<li><a href="page-thankyou.html">Thank you page</a></li>
										</ul>
									</li>
									<li class="menu-item has-dropdown typo-light">
										<a>Mega menu</a>
										<div class="mega-menu px-w600 pd-tiny">
											<div class="row gt40" data-rgen-sm="row-sep-reset gt0">
												<div class="col-md-6" data-rgen-sm="mr-b-20">
													<h3 class="title fs14 bold-n">Title text</h3>
													<hr class="light mr-tb-10">
													<ul class="list-1 mb6">
														<li><a href="#">Mega menu link 01</a></li>
														<li><a href="#">Mega menu link 02</a></li>
														<li><a href="#">Mega menu link 03</a></li>
														<li><a href="#">Mega menu link 04</a></li>
														<li><a href="#">Mega menu link 05</a></li>
														<li><a href="#">Mega menu link 06</a></li>
													</ul>
												</div><!-- // END : column //  -->
												
												<div class="col-md-6" data-rgen-sm="mr-b-20">
													<h3 class="title fs14 bold-n">Title text</h3>
													<hr class="light mr-tb-10">
													<ul class="list-1 mb6">
														<li><a href="#">Mega menu link 01</a></li>
														<li><a href="#">Mega menu link 02</a></li>
														<li><a href="#">Mega menu link 03</a></li>
														<li><a href="#">Mega menu link 04</a></li>
														<li><a href="#">Mega menu link 05</a></li>
														<li><a href="#">Mega menu link 06</a></li>
													</ul>
												</div><!-- // END : column //  -->
											</div><!-- // END : row //  -->
										</div>
									</li>
								</ul><!-- // END : Navigation links //  -->
							</nav><!-- // END : Nav //  -->
						</li>

						<li class="col-md-auto" data-rgen-sm="pd-0 pd-t-10 align-c">
							<a href="#contact" class="btn btn-white mini"><i class="far fa-envelope mr-r-5"></i> CONTACT US</a>
						</li>
					</ul>

				</div><!-- // END : Column //  -->

			</div><!-- // END : row //  -->

		</div><!-- // END : container //  -->
	</header>


	<!--
	************************************************************
	* Footer section
	************************************************************ -->
	<footer class="pos-rel pd-tb-small bg-dark" data-rgen-sm="pd-tb-small">
		<div class="container typo-light" data-rgen-sm="align-c">
			<div class="row gt20 mb20">
				<div class="col-md-6">
					<p><a href="https://goo.gl/ZMxnYs" target="_blank" class="inline-block max-px-w150"><img src="images/logo-light.png" class="max-px-w140" alt="logo"></a></p>
					<p>PO Box 16122, Collins Street West,<br>Victoria 8007, Australia</p>
					
					<!--=========================================
					=  Social links
					=============================================-->
					<a href="https://www.facebook.com/rgenesisart/" target="_blank" class="sq30 fs16 mr-r-4 rd-4 iconbox btn-white"><i class="fab fa-facebook-f"></i></a>
					<a href="https://twitter.com/rgenesisart" target="_blank" class="sq30 fs16 mr-r-4 rd-4 iconbox btn-white"><i class="fab fa-twitter"></i></a>
					<a href="https://plus.google.com/+RGenesis" target="_blank" class="sq30 fs16 mr-r-4 rd-4 iconbox btn-white"><i class="fab fa-google"></i></a>
					<a href="https://www.youtube.com/channel/UC6zqsNIOeHQUODHcP70fx8w" target="_blank" class="sq30 fs16 mr-r-4 rd-4 iconbox btn-white"><i class="fab fa-youtube"></i></a>
					<a href="http://r-genesis-art.tumblr.com/" target="_blank" class="sq30 fs16 mr-r-4 rd-4 iconbox btn-white"><i class="fab fa-tumblr"></i></a>
				</div>
				
				<div class="col-md-6">
					<h2 class="title tiny">NEWSLETTERS</h2>
					<p class="op-07">Subscribe for our monthly newsletter to stay updated</p>
					
					<!--=================================
					= Newsletter section
					==================================-->
					<div class="subscribe-block _1">
						<form action="form-data/notify-me.php" class="form-widget" data-formtype="newsletter">
							<div class="form-group">
								<button type="submit" data-loading-text="Pleae wait.." class="btn btn-white bdr-glass fs26"><i class="fa fa-envelope-o"></i></button>
								<input class="form-control bdr-white w100" data-label="Email" data-msg="Please enter email." type="email" name="email" placeholder="Enter your email">
							</div>
						</form>
					</div><!-- ======= END : Newsletter section =======  -->

				</div>
			</div>

			<hr class="light">
			<p class="mr-0 op-05"><a href="https://goo.gl/ZMxnYs" target="_blank">R.Gen - landing pages</a> &copy; <span class="copyright-year"></span></p>
		</div>
	</footer><!-- / Footer section -->
	<!-- ************** END : Footer section **************  -->


</div>
<!-- /#page --> 

<script src="js/webfonts.js" type="text/javascript"></script>

<script src="lib/jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="lib/jquery/jquery-migrate-3.0.0.min.js" type="text/javascript"></script>
<script src="lib/jquery/popper.min.js" type="text/javascript"></script>
<script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="lib/jquery-smooth-scroll/jquery.smooth-scroll.min.js" type="text/javascript"></script>
<script src="lib/jQuery-viewport-checker/jquery.viewportchecker.min.js" type="text/javascript"></script>
<script src="lib/Swiper/js/swiper.min.js" type="text/javascript"></script>
<script src="lib/owl-carousel/owl.js" type="text/javascript"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script src="lib/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="lib/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="lib/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>

<script src="lib/sweetalert/sweetalert2.min.js" type="text/javascript"></script>
<script src="lib/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="lib/youtubebackground/jquery.youtubebackground.js" type="text/javascript"></script>
<script src="lib/Vide/jquery.vide.min.js" type="text/javascript"></script>
<script src="lib/vegas/vegas.min.js" type="text/javascript"></script>
<script src="lib/materialize-parallax/materialize-parallax.js" type="text/javascript"></script>
<script src="lib/countUp/countUp.js" type="text/javascript"></script>
<script src="lib/stellar/jquery.stellar.min.js" type="text/javascript"></script>
<script src="js/enquire.min.js" type="text/javascript"></script>
<script src="js/main.js"></script>



</body>
</html>',
        'googleFonts' =>
            array (
                'Open Sans' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '300',
                                1 => '400',
                                2 => '400i',
                                3 => '600',
                                4 => '600i',
                                5 => '700',
                                6 => '700i',
                                7 => '800',
                                8 => '800i',
                                9 => '300i',
                            ),
                    ),
                'Montserrat' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                                4 => '100',
                                5 => '100i',
                                6 => '200',
                                7 => '200i',
                                8 => '300',
                                9 => '300i',
                                10 => '500',
                                11 => '500i',
                                12 => '600',
                                13 => '600i',
                                14 => '800',
                                15 => '800i',
                                16 => '900',
                                17 => '900i',
                            ),
                    ),
                'Roboto' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                                4 => '100',
                                5 => '100i',
                                6 => '300',
                                7 => '300i',
                                8 => '500',
                                9 => '500i',
                                10 => '900',
                                11 => '900i',
                            ),
                    ),
                'Roboto Slab' =>
                    array (
                        'category' => 'serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '100',
                                3 => '300',
                            ),
                    ),
                'Raleway' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                            ),
                    ),
                'Oswald' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '300',
                                3 => '500',
                                4 => '600',
                                5 => '200',
                            ),
                    ),
                'Playfair Display' =>
                    array (
                        'category' => 'serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                                4 => '900',
                                5 => '900i',
                            ),
                    ),
                'Rancho' =>
                    array (
                        'category' => 'handwriting',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                            ),
                    ),
                'Open Sans Condensed' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '700',
                                1 => '700i',
                                2 => '300',
                                3 => '300i',
                            ),
                    ),
                'Lato' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                                4 => '300',
                                5 => '300i',
                                6 => '100',
                                7 => '100i',
                                8 => '900',
                                9 => '900i',
                            ),
                    ),
                'PT Sans' =>
                    array (
                        'category' => 'sans-serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                            ),
                    ),
                'PT Serif' =>
                    array (
                        'category' => 'serif',
                        'subsets' =>
                            array (
                            ),
                        'variants' =>
                            array (
                                0 => '400',
                                1 => '700',
                                2 => '400i',
                                3 => '700i',
                            ),
                    ),
            ),
    );
    File::copyDirectory(public_path('Builder/config'), public_path('frontend_web/'.$web_id.'/config'));
    File::copyDirectory(public_path('Builder/css'), public_path('frontend_web/'.$web_id.'/css'));
    File::copyDirectory(public_path('Builder/fonts'), public_path('frontend_web/'.$web_id.'/fonts'));
    File::copyDirectory(public_path('Builder/icons'), public_path('frontend_web/'.$web_id.'/icons'));
    File::copyDirectory(public_path('Builder/images'), public_path('frontend_web/'.$web_id.'/images'));
    File::copyDirectory(public_path('Builder/js/code-editor'), public_path('frontend_web/'.$web_id.'/js/code-editor'));
    File::copyDirectory(public_path('Builder/js/jquery'), public_path('frontend_web/'.$web_id.'/js/jquery'));
    File::copyDirectory(public_path('Builder/js/workers'), public_path('frontend_web/'.$web_id.'/js/workers'));
    File::copyDirectory(public_path('Builder/lang'), public_path('frontend_web/'.$web_id.'/lang'));
    File::copyDirectory(public_path('Builder/php'), public_path('frontend_web/'.$web_id.'/php'));
    File::copyDirectory(public_path('Builder/plugins'), public_path('frontend_web/'.$web_id.'/plugins'));
    File::copyDirectory(public_path('Builder/rgen'), public_path('frontend_web/'.$web_id.'/rgen'));
    File::copyDirectory(public_path('Builder/lang'), public_path('frontend_web/'.$web_id.'/lang'));

    File::copyDirectory(public_path('Builder/projects/template/css'), public_path('frontend_web/'.$web_id.'/projects/template/css'));
    File::copyDirectory(public_path('Builder/projects/template/elements'), public_path('frontend_web/'.$web_id.'/projects/template/elements'));
    File::copyDirectory(public_path('Builder/projects/template/fonts'), public_path('frontend_web/'.$web_id.'/projects/template/fonts'));
    File::copyDirectory(public_path('Builder/projects/template/form-data'), public_path('frontend_web/'.$web_id.'/projects/template/form-data'));
    File::copyDirectory(public_path('Builder/projects/template/images'), public_path('frontend_web/'.$web_id.'/projects/template/images'));
    File::copyDirectory(public_path('Builder/projects/template/js'), public_path('frontend_web/'.$web_id.'/projects/template/js'));
    File::copyDirectory(public_path('Builder/projects/template/lib'), public_path('frontend_web/'.$web_id.'/projects/template/lib'));
    File::copyDirectory(public_path('Builder/projects/template/novi'), public_path('frontend_web/'.$web_id.'/projects/template/novi'));


    $builderjs  =   File::get(public_path('Builder/js/builder.min.js'));
    File::put(public_path('frontend_web/'.$web_id.'/js/builder.min.js'), str_replace('{web_id}', $web_id, $builderjs));
    File::copy(public_path('Builder/projects/template/'.$template.'.html'), public_path('frontend_web/'.$web_id.'/projects/template/index.html'));
    File::copy(public_path('Builder/projects/template/novi/pages/'.$template.'.jpg'), public_path('frontend_web/'.$web_id.'/projects/template/index.jpg'));
    File::copy(public_path('Builder/index.html'), public_path('frontend_web/'.$web_id.'/index.html'));
    File::put(public_path('frontend_web/'.$web_id.'/projects/template/project.json'), json_encode($project_template));
}

function transliterateString($txt) {
    $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
}

function saveProject($web_id, $project)
{
    $json_project = base64_decode($project);
    $projectObj = json_decode($json_project, true);
    if (isset($projectObj) && $projectObj != "null") {
        $dir = public_path("frontend_web/$web_id/" . $projectObj["dir"]);
        if (!file_exists($dir)) {
            mkdir($dir, 0777);
        }
        $files    = scandir($dir);
        $newFiles = array();

        if (isset($projectObj["filesToDelete"])){
            for ($i = 0; $i < count($projectObj["filesToDelete"]); $i++) {
                $targetFile = $dir . $projectObj["filesToDelete"][$i];
                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }
            }
            unset($projectObj["filesToDelete"]);
        }


        if (isset($projectObj["pages"])) {
            for ($i = 0; $i < count($projectObj["pages"]); $i++) {

                if (!isset($projectObj["pages"][$i]["html"])) {
                    if (($key = array_search($projectObj["pages"][$i]["path"], $files)) !== false) {
                        unset($files[$key]);
                    }
                    continue;
                }

                if ($projectObj["pages"][$i]["path"] === "index.html"){
                    $htmlPath = $dir . "/" . $projectObj["pages"][$i]["path"];
                    $fileName = $projectObj["pages"][$i]["path"];
                }else{
                    $htmlPath = $dir . "/" . $projectObj["pages"][$i]["path"];
                    $fileName = basename($projectObj["pages"][$i]["path"]);
                }

                if (($key = array_search($fileName, $files)) !== false) {
                    unset($files[$key]);
                }

                $fp = fopen($htmlPath, "wb");
                fwrite($fp, $projectObj["pages"][$i]["html"]);
                fclose($fp);
                unset($projectObj["pages"][$i]["html"]);
            }
        }

        if (!file_exists($dir . "elements")){
            mkdir($dir . "elements", 0777);
        }

        if (isset($projectObj["presets"])) {
            $presetsDir   = $dir . "elements";
            $presetsFiles = scandir($presetsDir);
            $newFiles     = array();
            for ($i = 0; $i < count($projectObj["presets"]); $i++) {
                if (!isset($projectObj["presets"][$i]["html"])) {
                    array_push($newFiles, $projectObj["presets"][$i]["path"]);
                }
            }
            for ($i = 0; $i < count($projectObj["presets"]); $i++) {
                if (isset($projectObj["presets"][$i]["html"])) {
                    $title       = preg_replace("/\s+/", "-", strtolower(preg_replace('/[\?|\||\\|\/|\:|\*|\>|\<|\.|\"|\,]/', "", $projectObj["presets"][$i]["title"])));
                    $title = transliterateString($title);
                    $newFileName = $title . ".html";
                    $j           = 0;
                    if (in_array($newFileName, $newFiles)) {
                        $j = 1;
                        while (in_array($title . "-" . $j . ".html", $newFiles)) {
                            $j++;
                        }
                        $newFileName = $title . "-" . $j . ".html";
                    }
                    array_push($newFiles, $newFileName);
                    $projectObj["presets"][$i]["path"] = $newFileName;
                    $htmlPath                          = $presetsDir . "/" . $newFileName;
                    $fileName                          = $newFileName;
                    if (($key = array_search($fileName, $presetsFiles)) !== false) {
                        unset($presetsFiles[$key]);
                    }
                    if (isset($projectObj["presets"][$i]["html"])) {
                        $fp = fopen($htmlPath, "wb");
                        fwrite($fp, $projectObj["presets"][$i]["html"]);
                        fclose($fp);
                    }

                    if (isset($projectObj["presets"][$i]["preview"]) && !empty($projectObj["presets"][$i]["preview"]) && file_exists($dir . $projectObj["presets"][$i]["preview"])){
                        $ext     = pathinfo($dir . $projectObj["presets"][$i]["preview"]);
                        $preview = basename($dir . $projectObj["presets"][$i]["preview"], "." . $ext['extension']);
                        if (($j == 0 && $preview != $title) || ($j > 0 && $preview != $title . "-" . $j)) {
                            $ext = "." . $ext["extension"];
                            if ($j > 0) {
                                $newPreviewName = $title . "-" . $j;
                            } else {
                                $newPreviewName = $title;
                            }
                            if (file_exists($presetsDir . "/" . $newPreviewName . $ext)) {
                                $k = 1;
                                while (file_exists($presetsDir . "/" . $newPreviewName . "-" . $k . $ext)) {
                                    $k++;
                                }
                                $newPreviewName = $newPreviewName . "-" . $k;
                            }
                            rename($dir . $projectObj["presets"][$i]["preview"], $presetsDir . "/" . $newPreviewName . $ext);
                            $projectObj["presets"][$i]["preview"] = "elements/" . $newPreviewName . $ext;
                        }
                    }
                    unset($projectObj["presets"][$i]["html"]);
                }
            }
            $presetsFiles = scandir($presetsDir);
            foreach ($presetsFiles as $key => $value) {
                if (preg_match("/[^\.]\..*$/", $value)) {
                    if (preg_match('/\.html$/', $value)) {
                        if (!in_array($value, $newFiles)) {
                            $preview = $presetsDir . "/" . basename($value, ".html");
                            if (file_exists($preview . ".jpg")) {
                                unlink($preview . ".jpg");
                            } else if (file_exists($preview . ".png")) {
                                unlink($preview . ".png");
                            }
                            unlink($presetsDir . "/" . $value);
                        }
                    } else {
                        $presetFile = basename($value);
                        $removeFile = true;
                        for ($i = 0; $i < count($projectObj["presets"]); $i++) {
                            $presetPreview = basename($projectObj["presets"][$i]["preview"]);
                            if ($presetPreview == $presetFile) {
                                $removeFile = false;
                                break;
                            }
                        }
                        if ($removeFile) {
                            if (file_exists($presetsDir . "/" . $value)) {
                                unlink($presetsDir . "/" . $value);
                            }
                        }
                    }
                }
            }
        }

        foreach ($files as $key => $value) {
            if (preg_match("/[^\.]\..*$/", $value) && $value != 'project.json') {
                unlink($dir . $value);
            }
        }

        if (isset($projectObj["files"])) {
            foreach ($projectObj["files"] as $key => $value) {
                $fp = fopen($dir . "/" . $key, "wb");
                fwrite($fp, $value["content"]);
                fclose($fp);
                unset($projectObj["files"][$key]);
            }
        }


        $file       = $dir . "project.json";
        echo $file;
        $projectStr = json_encode($projectObj);

        echo $projectStr;

        $fp         = fopen($file, "wb");
        fwrite($fp, $projectStr);
        fclose($fp);
    } else var_dump($projectObj);
}
function saveProjectByParts($web_id,$part, $index, $lastChunk)
{
    if (!$lastChunk) {
        $file = storage_path('app/temp/save-' . $index . '.txt');
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'));
        }
        if (file_exists($file)) {
            unlink($file);
        }
        file_put_contents($file, $part);
        echo "success";
    } else {
        $tmpDir      = storage_path('app/temp');
        $project = "";
        for ($i = 0; $i < $index; $i++) {
            $file = $tmpDir . "/save-" . $i . ".txt";
            if (file_exists($file)) {
                $project .= file_get_contents($file);
                unlink($file);
            }
        }
        $project .= $part;
//        echo $project;
        saveProject($web_id,$project);
    }
}
use PHPZip\Zip\File\Zip;
function zip($source, $destination)
{
    if (!file_exists($source)) {
        return false;
    }

    $zip = new Zip();
    $zip->setZipFile($destination);

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source))
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = str_replace('\\', '/', realpath($file));

            if (is_dir($file))
            {
                $dirName = str_replace($source . '/', '', $file . '/');
                $zip->addDirectory($dirName);
            }
            else if (is_file($file))
            {
                $relativeFile = str_replace($source . '/', '', $file);
                if (!preg_match('/^[^\/]*\.\/.*/', $relativeFile)){
                    $zip->addFile(file_get_contents($file), $relativeFile, 0, null, false);

                }else if (preg_match('/^[^\/]*\.(html)|project.json$/', $relativeFile)){
                    $zip->addFile(file_get_contents($file), $relativeFile, 0, null, false);
                }
            }
        }
    }
    else if (is_file($source))
    {
        $zip->addFile(file_get_contents($source), basename($source), 0, null, false);
    }

    $zip->finalize();

    return true;
}

function uploadFtp($sourceFolder, $destinationFolder){
    $dir    =   Storage::disk('ftp')->allDirectories();
}
function get_config($key, $default= null){
    $data   =   ShowingCfg::where('key', $key)->first();
    if(!empty($data))
        return $data->value;
    else
        return $default;
}
function activity($type, $action, $object_id){
    $user_id    =   auth()->check()?auth()->user()->id:0;
    $data   =   \App\Activity::where('user_id', $user_id)->where('type', $type)->where('object_id', $object_id)->where('created_at', '>=', Carbon\Carbon::now()->subMinute(5))->where('ip', request()->getClientIp());
    if(!empty($data->count()) && $user_id!=0){
        $data   =   $data->first();
        $data->increment('batch');
    }
    else{
        $data   =   new \App\Activity();
        $data->type     =   $type;
        $data->action   =   $action;
        $data->user_id  =   $user_id;
        $data->object_id    =   $object_id;
        $data->created_at   =   Carbon\Carbon::now();
        $data->batch    =   1;
        $data->ip   =   request()->getClientIp();
        $data->save();
    }

    return true;
}
function lam_tron($so)
{
    $thap_phan = $so - (int)$so;

    if ($thap_phan < 0.3)
        $thap_phan = 0;
    elseif ($thap_phan >= 0.3 && $thap_phan <= 0.5)
        $thap_phan = 0.5;
    elseif ($thap_phan > 0.5)
        $thap_phan = 1;

    $so = (int)$so + $thap_phan;

    return $so;
}

function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}

function ads_display($location){
    $province = 0;
    if(auth()->check())
        $province   =   auth()->user()->userinfo?auth()->user()->userinfo->province_id:0;
    $banner =   \App\Banner::where('location', $location)->where('province_id', $province);
    if($banner->count() == 0){
        $banner =   \App\Banner::where('location', $location)->where('province_id', 0)->get();
    }else
        $banner =   $banner->get();

    return $banner;
}
function convert_number_to_words($number) {
    return number_format($number);
//    $hyphen      = ' ';
//    $conjunction = '  ';
//    $separator   = ' ';
//    $negative    = 'âm ';
//    $decimal     = ' phẩy ';
//    $dictionary  = array(
//        0                   => '0',
//        1                   => '1',
//        2                   => '2',
//        3                   => '3',
//        4                   => '4',
//        5                   => '5',
//        6                   => '6',
//        7                   => '7',
//        8                   => '8',
//        9                   => '9',
//        10                  => '10',
//        11                  => '11',
//        12                  => '12',
//        13                  => '13',
//        14                  => '14',
//        15                  => '15',
//        16                  => '16',
//        17                  => '17',
//        18                  => '18',
//        19                  => '19',
//        20                  => '20',
//        30                  => '30',
//        40                  => '40',
//        50                  => '50',
//        60                  => '60',
//        70                  => '70',
//        80                  => '80',
//        90                  => '90',
//        100                 => 'trăm',
//        1000                => 'ngàn',
//        1000000             => 'triệu',
//        1000000000          => 'tỷ',
//        1000000000000       => 'nghìn tỷ',
//        1000000000000000    => 'ngàn triệu triệu',
//        1000000000000000000 => 'tỷ tỷ'
//    );
//
//    if (!is_numeric($number)) {
//        return false;
//    }
//
//    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
//// overflow
//        trigger_error(
//            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
//            E_USER_WARNING
//        );
//        return false;
//    }
//
//    if ($number < 0) {
//        return $negative . convert_number_to_words(abs($number));
//    }
//
//    $string = $fraction = null;
//
//    if (strpos($number, '.') !== false) {
//        list($number, $fraction) = explode('.', $number);
//    }
//
//    switch (true) {
//        case $number < 21:
//            $string = $dictionary[$number];
//            break;
//        case $number < 100:
//            $tens   = ((int) ($number / 10)) * 10;
//            $units  = $number % 10;
//            $string = $dictionary[$tens];
//            if ($units) {
//                $string .= $hyphen . $dictionary[$units];
//            }
//            break;
//        case $number < 1000:
//            $hundreds  = $number / 100;
//            $remainder = $number % 100;
//            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
//            if ($remainder) {
//                $string .= $conjunction . convert_number_to_words($remainder);
//            }
//            break;
//        default:
//            $baseUnit = pow(1000, floor(log($number, 1000)));
//            $numBaseUnits = (int) ($number / $baseUnit);
//            $remainder = $number % $baseUnit;
//            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
//            if ($remainder) {
//                $string .= $remainder < 100 ? $conjunction : $separator;
//                $string .= convert_number_to_words($remainder);
//            }
//            break;
//    }
//
//    if (null !== $fraction && is_numeric($fraction)) {
//        $string .= $decimal;
//        $words = array();
//        foreach (str_split((string) $fraction) as $number) {
//            $words[] = $dictionary[$number];
//        }
//        $string .= implode(' ', $words);
//    }
//
//    return $string;
}
function menu(){
    return Menu::where('web_id', get_web_id())->where('menu_type', config('menu.mainMenuFE'))->first();
}
function post_left($user){
    $postlimit   =   $user->group()->first()->post_limit;
    $posted     =   RealEstate::where('posted_by', $user->id)->where('public_site', 1)->count();
    $postLeft   =   !empty($postlimit)?$postlimit-$posted:null;
    return ($postLeft!==null && $postLeft<1)?0:$postLeft;
}