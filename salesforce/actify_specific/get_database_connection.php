<?php

function get_database_connection()
{
	$mysqli = new mysqli('localhost', 'actify1_wpdb', 'x0FWX0ZyKElG', 'actify_actify');

	$mysqli->query("SET NAMES 'utf8'"); //Needed so that MySQL will actually use UTF-8 when inserting or selecting

	return $mysqli;
}

?>