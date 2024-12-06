<?php


function get_lead_owner_and_regional_sales_manager_and_email($country)
{
	$lines = file($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'country_lead_owner_regional_sales_manager.txt');


	foreach ($lines as $line)
	{
		$line_exploded = explode('::', $line, 3);


		if (count($line_exploded) == 3)
		{
			if ($country == trim($line_exploded[0]))
			{
				$owner_name = trim($line_exploded[1]);


				require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'get_owner_id_from_name.php');
				$owner_id = get_owner_id_from_name($owner_name);
				
				require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'get_email_from_name.php');
				$email = get_email_from_name($owner_name);


				return array( $owner_id, trim($line_exploded[2]), $email );
			}
		}
	}


	return array('', '', '');
}


?>