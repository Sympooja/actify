<?php

include "e2ma-keys.php";

$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
);

$memberid = $_GET["memberid"];
//Set URL to add member to groups
//PUT /#account_id/members/#member_id/groups
$url = $urlPrefix.$account_id."/members/".$memberid."/groups";
$myvars = file_get_contents('php://input');

    
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);

    curl_setopt($ch, CURLOPT_SSLVERSION, 6);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
    
    $response = curl_exec($ch);
    
    curl_close ($ch);
    
    return $response;

    echo $response;

?>