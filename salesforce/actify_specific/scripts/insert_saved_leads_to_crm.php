<?php

require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'CRMForm.php');

require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'get_database_connection.php');
$mysqli = get_database_connection();

$result = $mysqli->query('SELECT random_id, campaign_id FROM actify_unsubmitted_leads WHERE already_in_crm = FALSE LIMIT 10'); // Salesforce doesn't handle inserting leads quickly, so let's only do 10 at a time

while ($row = $result->fetch_array())
{
	$crm_data = CRMForm::create_from_db($mysqli, $row['random_id']);

	if ($crm_data)
	{
		if ($crm_data->submit_to_crm($row['campaign_id']))
		{
			// Delete the lead from the database
			$mysqli->query("DELETE FROM actify_unsubmitted_leads WHERE random_id = '{$row['random_id']}' LIMIT 1");
		}
	}
}

$result->close();
$mysqli->close();

?>