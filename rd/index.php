<?php
require_once '../Models/Shortner.php';
$ShortnerObj = new Shortner();
$url = $_SERVER['REQUEST_URI'];
$parse_url = parse_url($url, PHP_URL_QUERY);
if ($parse_url) {
    $ShortnerObj->getLongUrl(trim($parse_url));
    $longUrl = $ShortnerObj->L_Url;
    if($longUrl){
        header('Location: '.$longUrl);
    }
    else{
        header('Location:'. BASEPATH);
    }
} else {
    header('Location:'.BASEPATH);
}
?>
