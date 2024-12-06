<?php

include "e2ma-keys.php";

$memberid = $_GET["memberid"];

//Set URL to get member to groups
//GET /#account_id/members/#member_id/groups
$url = $urlPrefix.$account_id."/members/".$memberid."/groups";

// setup and execute the cURL command
$ch = curl_init();
curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$result=curl_exec($ch);
curl_close($ch);

// Prep results for ajax get
$str = $result;
$config = json_decode($str, true);
$json = json_encode($config);
//$cleanJSON = preg_replace("/'/", "\&#39;", $json);
echo $json;
//echo $cleanJSON;

