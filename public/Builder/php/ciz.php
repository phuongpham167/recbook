<?php

function reverseNumber($n){
    $reverse=0;
    while($n>0){
        $reverse=$reverse*10;
        $reverse=$reverse+$n%10;
        $n=(int)($n/10);
    }
    return($reverse);
}

function return_bytes($val) {
    $last = strtolower($val[strlen($val)-1]);
    $int = preg_replace('/[^0-9]/', '', $val);
    switch($last) {
      case 'g':
          $int *= 1024 * 1024 * 1024;
          break;
      case 'm':
          $int *= 1024 * 1024;
          break;
      case 'k':
          $int *= 1024;
          break;
    }
    return $int;
}

$logo = "/novi-logo.png";
$logo2x = "/novi-logo-2x.png";
$introLogo = "/intro-novi-logo.png";
$introLogo2x = "/intro-novi-logo-2x.png";
$checkdir = "../images";

if (file_exists($checkdir . $logo) && file_exists($checkdir . $logo2x) && file_exists($checkdir . $introLogo) && file_exists($checkdir . $introLogo2x))
    { $response = array(
    "nl" => reverseNumber(filesize($checkdir . $logo)),
    "nl2" => reverseNumber(filesize($checkdir . $logo2x)),
    "inl" => reverseNumber(filesize($checkdir . $introLogo)),
    "inl2" => reverseNumber(filesize($checkdir . $introLogo2x)),
    "demoPass" => file_exists("./novi-intro-password.txt"),
    "settings" => array(
        "upload_max_filesize" => return_bytes(ini_get('upload_max_filesize')),
        "memory_limit" => return_bytes(ini_get('memory_limit')),
        "max_file_uploads" => ini_get('max_file_uploads'),
        "post_max_size" => return_bytes(ini_get('post_max_size'))
        )
    ); echo json_encode($response); } else echo -1;

