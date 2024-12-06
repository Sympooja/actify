<?php

/* Emma API Keys */
require 'e2ma-keys.php';

$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
);

    //Get Email Address from Form
    $email = $_GET["email"];

    $url = $urlPrefix.$account_id."/members/email/optout/".$email."";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);

    curl_setopt($ch, CURLOPT_SSLVERSION, 6);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    
    $response = curl_exec($ch);
    
    curl_close ($ch);
    
    if ($response == "true") {
    echo "1";
    } else {
    echo "0";
    }

?>