<?php

function get_partner_id($partner_name)
{
	$lines = file($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'partner_id_partner.txt');

	foreach ($lines as $line)
	{
		$line_exploded = explode(':', $line, 2);

		if (count($line_exploded) == 2)
		{
			if ($partner_name == trim($line_exploded[1]))
			{
				return trim($line_exploded[0]);
			}
		}
	}

	return '';
}

?>