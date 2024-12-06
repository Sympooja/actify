<?php

// Languages indexed by Windows LCID value
$languages = array(
	1033 => 'English',
	1031 => 'German',
	2052 => 'Simplified Chinese',
	1028 => 'Chinese',
	1036 => 'French',
	1040 => 'Italian',
	1041 => 'Japanese',
	1029 => 'Czech',
	1034 => 'Spanish',
	1042 => 'Korean',
	2070 => 'Portuguese',
);

// Enable the use of WordPress functions (so we can use the database functions and escape_salesforce_characters)
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '/wp-load.php');
require_once( __DIR__ . '/functions/functions.php' );

// Remove the stupid WordPress character escaping added to request data
actify_remove_wp_magic_quotes();

// Check that all the values are present
if (!isset($_REQUEST['p_SeatID']) || !isset($_REQUEST['p_FirstName']) || !isset($_REQUEST['p_LastName']) || !isset($_REQUEST['p_Company']) || !isset($_REQUEST['p_Country']) || !isset($_REQUEST['p_Email']) || !isset($_REQUEST['p_Type']) || !isset($_REQUEST['p_Version']) || !isset($_REQUEST['p_Language']) || !isset($_REQUEST['p_Address']) || !isset($_REQUEST['p_City']) || !isset($_REQUEST['p_State']) || !isset($_REQUEST['p_Zip']) || !isset($_REQUEST['p_Phone']))
{
	error('Required Values Not Given');
}

// Check if the email is valid
if (!filter_var($_REQUEST['p_Email'], FILTER_VALIDATE_EMAIL))
{
	error('Invalid Email');
}

// Setup the Product Interest value, with build version
if ($_REQUEST['p_Type'] == 'SpinFire' || $_REQUEST['p_Type'] == 'SpinFire Ultimate')
{
	$product_interest = 'SF Registered';

	$product_interest .= ' ' . trim($_REQUEST['p_Version']);
}
else
{
	error('Product Type Not Given');
}

// Get the language value
if (isset($languages[ $_REQUEST['p_Language'] ]))
{
	$language =  $languages[ $_REQUEST['p_Language'] ];
}
else
{
	$language = '';
}

// Set the OS
if (isset($_REQUEST['p_OS']) && $_REQUEST['p_OS'] != '')
{
	$user_operating_system = $_REQUEST['p_OS'];
}
// OS not given, so try to get it from the user agent
else
{
	// Try to determine the operating system
	$operating_systems = array( 'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
								'Windows Server 2003 or Windows XP x64 Edition' => '(Windows NT 5.2)',
								'Windows Vista' => '(Windows NT 6.0)',
								'Windows 7' => '(Windows NT 6.1)',
								'Windows 8' => '(Windows NT 6.2)');

	$user_operating_system = 'Unknown';

	// Find a match
	foreach($operating_systems as $operating_system_name => $operating_system_user_agent_value)
	{
		if ( preg_match('/' . $operating_system_user_agent_value . '/i', $_SERVER['HTTP_USER_AGENT']) )
		{
			$user_operating_system = $operating_system_name;

			break;
		}
	}
}

// Create the Salesforce lead array
$salesforce_lead = array();
$salesforce_lead['Seat_ID__c'] = $_REQUEST['p_SeatID'];
$salesforce_lead['FirstName'] = $_REQUEST['p_FirstName'];
$salesforce_lead['LastName'] = $_REQUEST['p_LastName'];
$salesforce_lead['Company'] = $_REQUEST['p_Company'];
$salesforce_lead['Email'] = $_REQUEST['p_Email'];
$salesforce_lead['Country'] = $_REQUEST['p_Country'];
$salesforce_lead['Product_Interest__c'] = $product_interest;
$salesforce_lead['Registration_OS__c'] = $user_operating_system;
$salesforce_lead['Language__c'] = $language;

// Check for the non mandatory values
if ($_REQUEST['p_Address'] != 'NA')
{
	$salesforce_lead['Street'] = $_REQUEST['p_Address'];
}
if ($_REQUEST['p_City'] != 'NA')
{
	$salesforce_lead['City'] = $_REQUEST['p_City'];
}
if ($_REQUEST['p_State'] != 'NA')
{
	$salesforce_lead['State'] = $_REQUEST['p_State'];
}
if ($_REQUEST['p_Zip'] != 'NA')
{
	$salesforce_lead['PostalCode'] = $_REQUEST['p_Zip'];
}
if ($_REQUEST['p_Phone'] != 'NA')
{
	$salesforce_lead['Phone'] = $_REQUEST['p_Phone'];
}

// Get the campaign ID for this version's registration, if it exists
// If we can not connect to Salesforce right now, we will not link the Lead to a Campaign
$campaign_id = null;
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'login_to_salesforce.php');
$salesforce_handle = login_to_salesforce();

if ($salesforce_handle)
{
	$search_result = $salesforce_handle->search('FIND {' . escape_salesforce_characters($product_interest) . "} IN Name FIELDS RETURNING Campaign (id)");

	// Check if there were any results
	if (isset($search_result->searchRecords))
	{
		// Check if there are multiple results. Should never happen, but if it does we'll just use the first one
		if (is_array($search_result->searchRecords))
		{
			$search_record = $search_result->searchRecords[0];
			$campaign_id = $search_record->record->Id;
		}
		else
		{
			$campaign_id =  $search_result->searchRecords->record->Id;
		}
	}
}

$campaign = array();
if ($campaign_id !== null)
{
	$campaign['CampaignId'] = $campaign_id;
	$campaign['Language__c'] = $language;
	$campaign['Registration_OS__c'] = $user_operating_system;
	$campaign['Seat_ID__c'] = $_REQUEST['p_SeatID'];
}

// Add the data to the CRM, saving it to the DB on Salesforce failure
actify_submit_lead_to_salesforce($salesforce_lead, $campaign);

// Add a meaningless success message
echo 'Success';

function error($reason)
{
	header("HTTP/1.1 500 Internal Server Error");
	echo $reason;
	exit();
}

?>