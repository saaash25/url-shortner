<?php
session_start();
require_once '../Modals/Shortner.php';
$ShortnerObj = new Shortner();
if (isset($_POST['action']) && $_POST['action'] == 'urlShorten') {
    
    $charString = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($charString);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $charString[rand(0, $charLength - 1)];
    }
    $longURL = $_REQUEST['longUrl'];
    $shortURL = BASEPATH . 'rd?' . $randomString;
    $ShortnerObj->URL_DataArray = array(
        'URL_LongUrl' => $longURL,
        'URL_ShortUrl' => $shortURL,
        'URL_ShortCode' => $randomString,
        'URL_AddedDate' => date('Y-m-d H:i:s'),
    );
    $insertedId = $ShortnerObj->doUrlShorten();
    if ($insertedId) {
        $StatusArray = array(
            'status' => 1,
            'shortUrl' => $shortURL
        );
    } else {
        $StatusArray = array(
            'status' => 0,
        );
    }
    echo json_encode($StatusArray);
}
if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $ShortnerObj->adminAuthenticate($username, $password);
    $userData = $ShortnerObj->UserDetails;
    
    if ($userData) {
        $_SESSION['US_Id'] = $userData->US_Id;
        $_SESSION['US_Username'] = $userData->US_Username;

        $StatusArray = array(
            'status' => 1,
        );
    } else {
       $StatusArray = array(
            'status' => 0,
        );
    }
    echo json_encode($StatusArray);
}
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    echo json_encode(array('url' => BASEPATH));
}
if (isset($_POST['action']) && $_POST['action'] == 'urlListing') {
    setcookie('urlLength', $_REQUEST['length']);
    $ShortnerObj->urlListing();
    $URLS = $ShortnerObj->URLS;
    $i = $_REQUEST['start'] + 1;
    foreach ($URLS as $key => $val) {
        $val->SLNO = $i;
         $val->AddedDate=date('d-m-Y',strtotime($val->URL_AddedDate)); 
        $i++;
    }
    $totalCount=count($URLS);
    $filterCount=count($URLS);
    $results = ["draw" => intval($_REQUEST['draw']),
        "recordsTotal" => $totalCount,
        "recordsFiltered" => $filterCount,
        "data" => $URLS];
    echo json_encode($results);
}
?>