<?php

// Enable the use of WordPress functions (so we can use the database functions and escape_salesforce_characters)
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '/wp-load.php');
require_once( __DIR__ . '/functions/functions.php' );

// Remove the stupid WordPress character escaping added to request data
actify_remove_wp_magic_quotes();

if (!isset($_REQUEST['seat_id']))
{
	// Display an error message
	header("HTTP/1.1 500 Internal Server Error");
	echo 'No Seat ID Given';
	exit();
}

actify_do_install_update_in_salesforce($_REQUEST['seat_id']);

// Display success message (because from the perspective of SpinFire, it submitted successfully)
echo 'Success';

?>