<?php

include "e2ma-keys.php";

$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
);

$memberid = $_GET["memberid"];
//Set URL for get member details
$url = $urlPrefix.$account_id."/members/".$memberid;
$myvars = file_get_contents('php://input');
   
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);

    curl_setopt($ch, CURLOPT_SSLVERSION, 6);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
    
    $response = curl_exec($ch);
    
    curl_close ($ch);
    
    //return $response;
    if ($response == "true") {
    echo "1";
    } else {
    echo "0";
    }
    //echo "Update Complete";

?>