<?php


function get_email_from_name($owner_name)
{
	$lines = file($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'salesforce_user_name_email.txt');


	foreach ($lines as $line)
	{
		$line_exploded = explode(':', $line, 2);


		if (count($line_exploded) == 2)
		{
			if ($owner_name == trim($line_exploded[0]))
			{
				return trim($line_exploded[1]);
			}
		}
	}

	return null;
}


?>