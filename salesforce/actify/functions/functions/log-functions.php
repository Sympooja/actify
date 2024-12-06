<?php

function var_log($var, $var_name, $action_name) {
	
	$message = "";
	
	$message .= $var_name . " = \n ";
	foreach($var as $k => $v){
			$message .= "      $var_name <b>$k</b>: $v\n";
	}

	send_to_log($message, $action_name);

}

function send_to_log($message, $action_name )
{
	$use_error_log=$_SERVER['DOCUMENT_ROOT'] . "/error_log";
	//ini_set("error_log", $use_error_log);
	$message = "[" . date("Y-m-d H:i:s") . "] " . $_SERVER['SERVER_NAME'] . " - " . $action_name . " - " . $message . " \n\n";
	error_log($message, 3, $use_error_log);
}
