<?php

include "e2ma-keys.php";

//Get Email Address from Form
$memberid = $_GET["memberid"];

//Set URL for get member details
$url = $urlPrefix.$account_id."/members/".$memberid."";

// setup and execute the cURL command
$ch = curl_init();

curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSLVERSION, 6);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$user=curl_exec($ch);

curl_close($ch);

// Prep results for ajax get
$str = $user;

$config = json_decode($str, true);
$json = json_encode($config);

echo $json;

?>