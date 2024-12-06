<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/wp-content/themes/enfold-child/functions/log-functions.php");


// Certain characters used in Salesforce queries need to be escaped
function escape_salesforce_characters($to_escape)
{
	$salesforce_reserved_characters_search = array('?', '&', '|', '!', '{', '}', '[', ']', '(', ')', '^', '~', '*', ':', '\\', '"', "'", '+', '-');
	$salesforce_reserved_characters_replace = array('\?', '\&', '\|', '\!', '\{', '\}', '\[', '\]', '\(', '\)', '\^', '\~', '\*', '\:', '\\\\', '\"', "\'", '\+', '\-');
	
	return str_replace($salesforce_reserved_characters_search, $salesforce_reserved_characters_replace, $to_escape);
}

// Load the list of countries based on the current language
add_filter("gform_countries", "actify_set_countries");
function actify_set_countries($countries)
{
	require_once(get_stylesheet_directory() . '/functions/countries/get_countries.php');
	
	$countries = get_countries();
	
	// Now we will sort the list of countries alphabetically
	
	// Remove the last 3 'Other' entries as they will always be last
	$last_choices = array_slice($countries, -3, 3);
	
	// Get the rest of the choices, which will be sorted
	$the_rest = array_slice($countries, 0, count($countries) - 3);
	
	// Depending on the language, remove one country from the array (so it can be shown first)
	if (ICL_LANGUAGE_CODE == 'en')
	{
		// Show 'United States (USA)' first
		$index_name = 'United States (USA)';
		
		$first_choice = array($index_name => $the_rest[$index_name]);
		
		// Remove it from the list of countries
		unset($the_rest[$index_name]);
	}
	else if (ICL_LANGUAGE_CODE == 'en-gb')
	{
		// Show 'United Kingdom' first
		$index_name = 'United Kingdom';
		
		$first_choice = array($index_name => $the_rest[$index_name]);
		
		// Remove it from the list of countries
		unset($the_rest[$index_name]);
	}
	else if (ICL_LANGUAGE_CODE == 'de')
	{
		// Show 'Germany' first
		$index_name = 'Germany';
		
		$first_choice = array($index_name => $the_rest[$index_name]);
		
		// Remove it from the list of countries
		unset($the_rest[$index_name]);
	}
	else
	{
		$first_choice = array();
	}
	
	// Now sort the rest of the countries	
	// Sort based on the locale (so accents on letters are handled properly)
	$old_locale = setlocale(LC_COLLATE, '0');
	setlocale(LC_COLLATE, ICL_LANGUAGE_CODE . '.utf8');
	asort($the_rest, SORT_LOCALE_STRING);
	setlocale(LC_COLLATE, $old_locale);
	
	// Combine them again
	$countries = array_merge($first_choice, $the_rest, $last_choices);
	
	return $countries;
}

// Used to turn a dropdown with the CSS class 'actify-gforms-country-dropdown' in to a country dropdown
function actify_gforms_populate_country_dropdown($form)
{
	require_once(get_stylesheet_directory() . '/functions/countries/get_countries.php');
	$countries = get_countries();
	
	foreach($form['fields'] as &$field)
	{
		if($field['type'] == 'select' && $field['cssClass'] == 'actify-gforms-country-dropdown')
		{
			$choices = array();
			
			$choices[] = array('text' => '', 'value' => '');
			
			foreach ($countries as $country_name => $english_country_name)
			{
				$choices[] = array('text' => $country_name, 'value' => $english_country_name);
			}
			
			$field['choices'] = $choices;
		}
	}
	
	return $form;
}
add_filter('gform_pre_render', 'actify_gforms_populate_country_dropdown');

// Prepopulate form fields
add_filter("gform_field_value_salutation", "actify_populate_salutation");
function actify_populate_salutation($value)
{
	if (isset($_COOKIE['actify_form']['salutation']))
	{
		$value = $_COOKIE['actify_form']['salutation'];
	}
	
	return $value;
}
add_filter("gform_field_value_first_name", "actify_populate_first_name");
function actify_populate_first_name($value)
{
	if (isset($_COOKIE['actify_form']['first_name']))
	{
		$value = $_COOKIE['actify_form']['first_name'];
	}
	
	return $value;
}
add_filter("gform_field_value_last_name", "actify_populate_last_name");
function actify_populate_last_name($value)
{
	if (isset($_COOKIE['actify_form']['last_name']))
	{
		$value = $_COOKIE['actify_form']['last_name'];
	}
	
	return $value;
}
add_filter("gform_field_value_company", "actify_populate_company");
function actify_populate_company($value)
{
	if (isset($_COOKIE['actify_form']['company']))
	{
		$value = $_COOKIE['actify_form']['company'];
	}
	
	return $value;
}
add_filter("gform_field_value_title", "actify_populate_title");
function actify_populate_title($value)
{
	if (isset($_COOKIE['actify_form']['title']))
	{
		$value = $_COOKIE['actify_form']['title'];
	}
	
	return $value;
}
add_filter("gform_field_value_phone", "actify_populate_phone");
function actify_populate_phone($value)
{
	if (isset($_COOKIE['actify_form']['phone']))
	{
		$value = $_COOKIE['actify_form']['phone'];
	}
	
	return $value;
}
add_filter("gform_field_value_email", "actify_populate_email");
function actify_populate_email($value)
{
	if (isset($_COOKIE['actify_form']['email']))
	{
		$value = $_COOKIE['actify_form']['email'];
	}
	
	return $value;
}
add_filter("gform_field_value_street1", "actify_populate_street1");
function actify_populate_street1($value)
{
	if (isset($_COOKIE['actify_form']['street1']))
	{
		$value = $_COOKIE['actify_form']['street1'];
	}
	
	return $value;
}
add_filter("gform_field_value_street2", "actify_populate_street2");
function actify_populate_street2($value)
{
	if (isset($_COOKIE['actify_form']['street2']))
	{
		$value = $_COOKIE['actify_form']['street2'];
	}
	
	return $value;
}
add_filter("gform_field_value_city", "actify_populate_city");
function actify_populate_city($value)
{
	if (isset($_COOKIE['actify_form']['city']))
	{
		$value = $_COOKIE['actify_form']['city'];
	}
	
	return $value;
}
add_filter("gform_field_value_state", "actify_populate_state");
function actify_populate_state($value)
{
	if (isset($_COOKIE['actify_form']['state']))
	{
		$value = $_COOKIE['actify_form']['state'];
	}
	
	return $value;
}
add_filter("gform_field_value_zip_code", "actify_populate_zip_code");
function actify_populate_zip_code($value)
{
	if (isset($_COOKIE['actify_form']['zip_code']))
	{
		$value = $_COOKIE['actify_form']['zip_code'];
	}
	
	return $value;
}
add_filter("gform_field_value_country", "actify_populate_country");
function actify_populate_country($value)
{
	if (isset($_COOKIE['actify_form']['country']))
	{
		$value = $_COOKIE['actify_form']['country'];
	}
	
	return $value;
}

// Save form field values as cookies for prepopuluation
function actify_save_form_field_values(array $field_values)
{
	$thirty_days_from_now = time()+60*60*24*30;

	foreach ($field_values as $field_name => $value)
	{
		setcookie("actify_form[$field_name]", $value, $thirty_days_from_now, '/');
	}
}

// Set a dynamic confirmation message
function actify_set_dynamic_confirmation_message($confirmation_message)
{
	// If the confirmation_message value is an URL
	if (substr($confirmation_message, 0, 7) == 'http://')
	{
		return array('redirect' => $confirmation_message);
	}	
	// If the confirmation message is a number it is a page id
	else if ( ctype_digit($confirmation_message) )
	{
		return array('redirect' => get_permalink( icl_object_id($confirmation_message, 'page', true) ));
	}
	// Otherwise it is a text message
	else
	{
		return $confirmation_message;
	}
}

// Get the language folder for emails from the given lead language
function actify_get_email_language_code($lead_language)
{
	if ($lead_language == 'English')
	{
		$email_language = 'en';
	}
	else if ($lead_language == 'German')
	{
		$email_language = 'de';
	}
	else if ($lead_language == 'Simplified Chinese')
	{
		$email_language = 'zh-hans';
	}
	else if ($lead_language == 'Chinese')
	{
		$email_language = 'zh-hans';
	}
	else
	{
		$email_language = ICL_LANGUAGE_CODE;
	}
	
	return $email_language;
}

// Returns the URL used for SpinFire Professional trial license requests
function actify_get_trial_license_request_url($language, $salutation, $first_name, $last_name, $company, $phone, $email, $street1, $street2, $city, $state, $zip_code, $country, $comments, $campaign_id = '', $product_interest = null, $version = null, $company_size = null, $given_seat_id = null, $eom_date = null, $license_type = null)
{	
	require_once( $_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_partner_id.php');
	$partner_id = get_partner_id( actify_get_default_partner_name() );

	$license_request_url = "http://actify.com/license_requestor/sf3.php?partner_id=" . rawurlencode($partner_id);

	$license_request_url .= '&language=' . rawurlencode( $language ) . 
							'&salutation=' . rawurlencode( $salutation ) . 
							'&first_name=' . rawurlencode( $first_name ) . 
							'&last_name=' . rawurlencode( $last_name ) . 
							'&company=' . rawurlencode( $company ) . 
							'&phone=' . rawurlencode( $phone ) .
							'&email=' . rawurlencode( $email ) . 
							'&street=' . rawurlencode( trim($street1 . ' ' . $street2) ) .
							'&city=' . rawurlencode( $city ) .
							'&state=' . rawurlencode( $state ) .
							'&zip_code=' . rawurlencode( $zip_code ) .
							'&country=' . rawurlencode( $country );
		
	if ($comments != '')
	{
		$license_request_url .= '&comments=' . rawurlencode($comments);
	}
	
	if ($campaign_id != '')
	{
		$license_request_url .= '&campaign_id=' . rawurlencode( $campaign_id );
	}
		
	if ($product_interest !== null)
	{
		$license_request_url .= '&product_interest=' . rawurlencode($product_interest);
	}			
	if ($version !== null)
	{
		$license_request_url .= '&version=' . rawurlencode($version);
	}
	if ($company_size !== null)
	{
		$license_request_url .= '&company_size=' . rawurlencode($company_size);
	}
	if ($given_seat_id !== null)
	{
		$license_request_url .= '&given_seat_id=' . rawurlencode($given_seat_id);
	}
	if ($eom_date !== null)
	{
		$license_request_url .= '&eom_date=' . rawurlencode($eom_date);
	}
	if ($license_type !== null)
	{
		$license_request_url .= '&license_type=' . rawurlencode($license_type);
	}
	
	$message = "actify_get_trial_license_request_url = " . $license_request_url;
    send_to_log($message, "forms.php - actify_get_trial_license_request_url");
	
	return $license_request_url;
}

// Returns the URL used for SpinFire Professional Upgrade requests
function actify_get_upgrade_license_request_url($seat_id, $salutation, $first_name, $last_name, $company, $phone, $email, $street1, $street2, $city, $state, $zip_code, $country)
{
	require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_partner_id.php');
	$partner_id = get_partner_id( actify_get_default_partner_name() );

	$license_request_url = "https://actify.com/license_requestor/sf2.php?type=sf84_upgrade&partner_id=" . rawurlencode($partner_id);

	$license_request_url .= '&seat_id=' . rawurlencode( $seat_id ) . 
							'&salutation=' . rawurlencode( $salutation ) . 
							'&first_name=' . rawurlencode( $first_name ) . 
							'&last_name=' . rawurlencode( $last_name ) . 
							'&company=' . rawurlencode( $company ) . 
							'&phone=' . rawurlencode( $phone ) .
							'&email=' . rawurlencode( $email ) . 
							'&street=' . rawurlencode( trim($street1 . ' ' . $street2) ) .
							'&city=' . rawurlencode( $city ) .
							'&state=' . rawurlencode( $state ) .
							'&zip_code=' . rawurlencode( $zip_code ) .
							'&country=' . rawurlencode( $country );
					
	return $license_request_url;
}

// Sends a license email for an upgrade or trial request
function actify_send_license_email($lead_id, $to, $subject, $body, $license = NULL, $floating_license = NULL)
{
	if ($lead_id != '')
	{
		// Convert newlines to <br>
		$body_html = nl2br($body);

		// Send email
		require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'login_to_salesforce.php');
		$salesforce_handle = login_to_salesforce();

		require_once(get_stylesheet_directory() . '/emails/send_lead_email.php');
		send_lead_email($salesforce_handle, $lead_id, $subject, $body, $body_html, $license, $floating_license);
	}
	else
	{
		// Salesforce must be down, so send the email from the server
		require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'phpMailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php');
		$mail = new phpmailer();

		$mail->From = 'sfmm@actify.com';
		$mail->FromName = 'Actify';
		$mail->AddAddress($to);
		$mail->CharSet = "UTF-8";
		$mail->Subject = $subject;
		$mail->Body = $body;

		if ($license !== NULL)
		{
			$mail->AddStringAttachment($license, 'license.al');
		}
		if ($floating_license !== NULL)
		{
			$mail->AddStringAttachment($floating_license, 'sfpflv2.dat');
		}

		$mail->Send();
	}
}

// Prepare lead arrays for submission to Salesforce
function actify_clean_salesforce_lead(array $lead)
{
	// Postal code can only be 20 characters long
	if (array_key_exists('PostalCode', $lead))
	{
		$lead['PostalCode'] = substr($lead['PostalCode'], 0, 20);
	}
	
	return $lead;
}

// Submits an array of lead values to Salesforce
// Returns Lead ID on success, 0 on failure, and -1 when there are missing mandatory Lead values
// Arguments
// - Salesforce Lead array
// - Campaign ID (or empty string)
// - Associative array of attachments where key is file name and value is base64 encoded file contents
// - Boolean indicating whether this is NOT the first attempt
function actify_submit_lead_to_salesforce(array $lead, array $campaign = array(), array $attachments = array(), $resubmission_attempt = false)
{
	// Check for mandatory variables
	if (!isset($lead['Email']) || !isset($lead['LastName']) || !isset($lead['Company']) || !isset($lead['Country']) || !isset($lead['Product_Interest__c']))
	{
		// Not given enough information, so just return
		return -1;
		$message = "Not given enough information, so just return";
		send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
       
	}
	
	// Scrub lead values if necessary
	$lead = actify_clean_salesforce_lead($lead);
	
	// Already set if a resubmission attempt
	if (!$resubmission_attempt)
	{
		$lead['LeadSource'] = 'Web';
		$lead['Reseller_Web_ID__c'] = actify_get_default_partner_name();
		
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list($lead_owner, $regional_sales_manager) = get_lead_owner_and_regional_sales_manager_and_email($lead['Country']);

		$lead['Regional_Sales_Manager__c'] = $regional_sales_manager;
		$lead['OwnerId'] = $lead_owner;
		
		// Set the campaign's regional sales manager too if necessary
		if (isset($campaign['CampaignId']))
		{
			$campaign['RSM__c'] = $regional_sales_manager;
		}
	}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/login_to_salesforce.php');
	$salesforce_handle = login_to_salesforce();

	if ($salesforce_handle)
	{	
		try
		{
			// $lead must be wrapped in an array, as create() can create many objects with a single API call
			$salesforce_result = $salesforce_handle->create(array($lead), 'Lead');
			
			var_log($salesforce_result, "SALESFORCE_RESULT", "forms.php - actify_submit_lead_to_salesforce");

			if ($salesforce_result->success)
			{
				$message = "salesforce_result = success.";
				send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
       
				$lead_id = $salesforce_result->id;
				$lead_id_type=gettype($lead_id);
				
				$message = "SALESFORCE LEAD ID = $lead_id and VAR TYPE = $lead_id_type.";
       			send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
				
				// Tie the lead to the campaign
				if (isset($campaign['CampaignId']))
				{
					$campaign['LeadId'] = $lead_id;
					$salesforce_handle->create(array($campaign), 'CampaignMember');
				}
				
				// Attach any files
				foreach ($attachments as $name => $encoded_contents)
				{
					$attachment = array();
					$attachment['Name'] = $name;
					$attachment['ParentId'] = $lead_id;
					$attachment['body'] = $encoded_contents;
					$salesforce_handle->create(array($attachment), 'Attachment');
				}
				
				$result = $lead_id;
				$message = "SUBMIT TO SALESFORCE RESULT = $result WHICH IS SAME AS LEAD_ID = $lead_id.";
       			send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
				$message = "LEAD VALUES IN SUBMIT-TO-SALESFORCE AFTER SUCCESS SUBMISSION TO SALESFORCE";
       			send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
				var_log($lead, "LEAD", "forms.php - actify_submit_lead_to_salesforce");
				
			}
			else
			{
				$message = "salesforce_result = not success  \n";
       			send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
				$result = 0;
			}
		}
		catch (Exception $e)
		{
			$message = "SALESFORCE HANDLE SUCCESSFUL BUT UNABLE TO CREATE SALESFORCE LEAD";
    		send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
		
			$result = 0;
		}
	}
	else  //Bad salesforce_handle - login to salesforce failed?
	{
		$message = "SALESFORCE HANDLE FAILED. BAD LOGIN TO SALESFORCE";
    	send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
		$result = 0;
	}
	
	// If the submission failed for the first time, save it to the DB so it can be reattempted
	if ($result === 0 && !$resubmission_attempt)
	{
		$result_type=gettype($result);
		$lead_id_type=gettype($lead_id);
		
		$message = "VAR RESULT EVALUATED TO 0 AND RESUBMISSION ATTEMPT EVALUATED TO FALSE SO WE HAVE TO ADD LEAD TO DB. \n HERE ARE VAR VALUES \n. VAR RESULT = $result AND RESUBMISSION ATTEMPT = $resubmission_attempt.\n";
		$message .= "TYPE OF VAR RESULT = $result_type .";
    	
		
		send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
	
		actify_save_lead_to_db($lead, $attachments, $campaign);
	}
	$message = "SUBMIT TO SALESFORCE RETURNING RESULT = $result TO CALLING FUNCTION.";
    send_to_log($message, "forms.php - actify_submit_lead_to_salesforce");
	return $result;
}

// Store a Salesforce lead array in the DB as JSON until it can be successfully submitted
function actify_save_lead_to_db(array $lead, array $attachments, array $campaign)
{
	global $wpdb;
	
	
	$message = "ADDING LEAD TO DB TABLE actify_unsubmitted_leads";
    	send_to_log($message, "forms.php - actify_save_lead_to_db");
				
	$wpdb->insert(
		'actify_unsubmitted_leads',
		array( 
			'lead_json' => json_encode($lead),
			'attachments_json' => json_encode($attachments),
			'campaign_json' => json_encode($campaign)
		), 
		array( 
			'%s',
			'%s',
			'%s' 
		)
	);
}

// Reattempt failed lead submissions
function actify_resubmit_leads_to_salesforce()
{
	global $wpdb;
	
	$unsubmitted_leads_table_name = 'actify_unsubmitted_leads';
	
	$rows = $wpdb->get_results("SELECT * FROM $unsubmitted_leads_table_name");
	
	// Go through all failed lead submissions
	foreach ($rows as $row)
	{
		$lead = json_decode($row->lead_json, true);
		$attachments = json_decode($row->attachments_json, true);
		$campaign = json_encode($row->campaign_json, true);
		
		// Resubmit the lead
		$result = actify_submit_lead_to_salesforce($lead, $campaign, $attachments, true);
		
		if ($result === 0)
		{
			// Failed, so log the resubmission attempt time
			$wpdb->query("UPDATE $unsubmitted_leads_table_name SET resubmission_attempted_at = NOW() WHERE id = {$row->id} LIMIT 1");
		}
		else
		{
			// Succeeded, or there is missing lead information (so it can never succeed), so delete it
			$wpdb->delete(
				$unsubmitted_leads_table_name,
				array('id' => $row->id),
				array('%d')
			);
		}
	}
}
// Schedule the lead resubmission to occur twice a day
function actify_resubmit_leads_to_salesforce_event_activation()
{
	if ( !wp_next_scheduled('actify_resubmit_leads_to_salesforce_event') )
	{
		wp_schedule_event(current_time('timestamp'), 'twicedaily', 'actify_resubmit_leads_to_salesforce_event');
	}
}
add_action('wp', 'actify_resubmit_leads_to_salesforce_event_activation');
add_action('actify_resubmit_leads_to_salesforce_event', 'actify_resubmit_leads_to_salesforce');

// Updates Salesforce Leads and Contacts that have a matching seat ID
function actify_do_install_update_in_salesforce($seat_id, $resubmission_attempt = false)
{
	require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/login_to_salesforce.php');
	$salesforce_handle = login_to_salesforce();
	
	if ($salesforce_handle)
	{
		// Search for Leads with the given seat ID, (escaping any hyphens in the FIND clause because they are reserved characters in the Salesforce search language)
		$search_result = $salesforce_handle->search('FIND {' . escape_salesforce_characters($seat_id) . "} RETURNING Lead (id WHERE Seat_ID__c = '$seat_id')");
		// Update any results
		$lead_update_result = actify_do_install_update_in_salesforce_helper($salesforce_handle, $search_result, 'Lead');

		// Search for Contacts with the given seat ID and update any results
		$search_result = $salesforce_handle->search('FIND {' . escape_salesforce_characters($seat_id) . "} RETURNING Contact (id WHERE Seat_ID__c = '$seat_id')");
		// Update any results
		$contact_update_result = actify_do_install_update_in_salesforce_helper($salesforce_handle, $search_result, 'Contact');

		if ($lead_update_result == 1 || $contact_update_result == 1)
		{
			// The updated succeeded
			$result = 1;
		}
		else if ($lead_update_result == 0 && $contact_update_result == 0)
		{
			// No Salesforce Lead/Contact found
			$result = 0;
		}
		else
		{
			// An update failed
			$result = -1;
		}
	}
	else
	{
		// Could not connect to Salesforce
		$result = -1;
	}
	
	if ($result != 1 && !$resubmission_attempt)
	{
		actify_save_install_update_to_db($seat_id);
	}
	
	return $result;
}

// Helper function
// Returns 1 if all found objects were updated
// Returns -1 if not all objects were updated
// Returns 0 if no objects were found
function actify_do_install_update_in_salesforce_helper($salesforce_handle, $search_result, $type)
{
	// Check if we find any results
	if (!isset($search_result->searchRecords))
	{
		// Nothing with that seat ID was found
		return 0;
	}
	
	// Check if there are multiple results - shouldn't happen but if it does we'll update all of them
	$objects_to_update = array();
	if (is_array($search_result->searchRecords))
	{
		foreach ($search_result->searchRecords as $search_record)
		{
			$objects_to_update[] = $search_record->record->Id;
		}
	}
	else
	{
		$objects_to_update[] = $search_result->searchRecords->record->Id;
	}

	// Update the objects(s)
	$update_failed = false;
	foreach ($objects_to_update as $object_id)
	{
		$object = array();
		$object['Id'] = $object_id;
		$object['Installed_Trial__c'] = true;

		$result = $salesforce_handle->update(array($object), $type);
		
		if (!$result->success)
		{
			// At least one update failed
			$update_failed = true;
		}
	}

	if ($update_failed)
	{
		return -1;
	}
	else
	{
		return 1;
	}
}

// Store an install update Seat ID in the database until it can be re-attempted
function actify_save_install_update_to_db($seat_id)
{
	global $wpdb;

	$unsubmitted_install_updates_table_name = 'actify_unsubmitted_trial_install_updates';
	
	// Check if the seat ID already exists in the table
	$id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $unsubmitted_install_updates_table_name WHERE seat_id = %s LIMIT 1", $seat_id));
	
	if ($id === null)
	{	
		// Seat ID was not already in the table

		$wpdb->insert(
			$unsubmitted_install_updates_table_name,
			array( 
				'seat_id' => $seat_id
			), 
			array( 
				'%s'
			)
		);
	}
}

// Reattempt failed install updates
function actify_reattempt_install_updates_in_salesforce()
{
	global $wpdb;
	
	$unsubmitted_install_updates_table_name = 'actify_unsubmitted_trial_install_updates';
	
	$rows = $wpdb->get_results("SELECT * FROM $unsubmitted_install_updates_table_name");
	
	// Go through all install updates
	foreach ($rows as $row)
	{
		$seat_id = $row->seat_id;
		
		// Calculate how many it has been since the last attempt
		$seconds_since_first_attempt = time() - strtotime($row->added_at);
		
		// Reattempt the update
		$result = actify_do_install_update_in_salesforce($seat_id, true);
		
		// Check if the update
		// 1. Succeeded, or
		// 2. Failed because there is no seat ID in Salesforce and it has been at least 2 days since the first attempt
		if ($result == 1 || ($result == 0 && $seconds_since_first_attempt >= 60*60*24*2))
		{
			// It succeeded, or it will never succeed, so delete it
			$wpdb->delete(
				$unsubmitted_install_updates_table_name,
				array('id' => $row->id),
				array('%d')
			);
		}
		else
		{
			// Failed, so update the last attempt timestamp
			$wpdb->query("UPDATE $unsubmitted_install_updates_table_name SET resubmission_attempted_at = NOW() WHERE id = {$row->id} LIMIT 1");
		}
	}
}
// Schedule the install updates reattempt to occur twice a day
function actify_reattempt_install_updates_in_salesforce_event_activation()
{
	if ( !wp_next_scheduled('actify_reattempt_install_updates_in_salesforce_event') )
	{
		wp_schedule_event(current_time('timestamp'), 'twicedaily', 'actify_reattempt_install_updates_in_salesforce_event');
	}
}
add_action('wp', 'actify_reattempt_install_updates_in_salesforce_event_activation');
add_action('actify_reattempt_install_updates_in_salesforce_event', 'actify_reattempt_install_updates_in_salesforce');

// Callback to delete Gravity Form entry from database
function actify_remove_gravity_form_entry_callback($lead, $form)
{
	actify_remove_gravity_form_entry($lead);
}

// Deletes a lead from the Gravity Form database
function actify_remove_gravity_form_entry($lead)
{ 
	global $wpdb;

	$message = "DELETING LEAD FROM GRAVITY FORMS IN WORDPRESS DB";
    send_to_log($message, "forms.php - actify_remove_gravity_form_entry");
	var_log($lead, "LEAD", "forms.php - actify_remove_gravity_form_entry");

	
	$lead_id                = $lead['id'];
	$lead_table             = RGFormsModel::get_lead_table_name();
	$lead_notes_table       = RGFormsModel::get_lead_notes_table_name();
	$lead_detail_table      = RGFormsModel::get_lead_details_table_name();
	$lead_detail_long_table = RGFormsModel::get_lead_details_long_table_name();

	// Delete from detail long
	$sql = $wpdb->prepare( " DELETE FROM $lead_detail_long_table
													WHERE lead_detail_id IN(
													SELECT id FROM $lead_detail_table WHERE lead_id=%d
													)", $lead_id );
	$wpdb->query( $sql );

	// Delete from lead details
	$sql = $wpdb->prepare( "DELETE FROM $lead_detail_table WHERE lead_id=%d", $lead_id );
	$wpdb->query( $sql );

	// Delete from lead notes
	$sql = $wpdb->prepare( "DELETE FROM $lead_notes_table WHERE lead_id=%d", $lead_id );
	$wpdb->query( $sql );

	// Delete from lead
	$sql = $wpdb->prepare( "DELETE FROM $lead_table WHERE id=%d", $lead_id );
	$wpdb->query( $sql );
}

// Clean up uploaded files
function actify_gforms_cleanup_temp_files()
{
	// Get the uploads directory
	$uploads = wp_upload_dir();
	
	$dir = new DirectoryIterator( $uploads['basedir'] . '/gravity_forms' );
	
	foreach ($dir as $fileinfo)
	{
		if (!$fileinfo->isDot() && $fileinfo->isDir())
		{
			// If the directory is older than three days, delete it
			if ($fileinfo->getMTime() <= strtotime("-3 day"))
			{
				actify_gforms_cleanup_temp_files_helper($fileinfo->getPathname());
			}
		}
	}
}

// Recursive function which deletes the contents of a given directory, and then the directory itself
function actify_gforms_cleanup_temp_files_helper($path)
{
	if (is_dir($path))
	{
		// Get all files/folders in directory that are not dots
		$files = array_diff(scandir($path), array('.', '..'));

		foreach ($files as $file)
		{
			actify_gforms_cleanup_temp_files_helper(realpath($path) . '/' . $file);
		}

		rmdir($path);
	}
	else if (is_file($path))
	{
		unlink($path);
	}
}

// Schedule the cleanup to occur once a day
function actify_gforms_cleanup_event_activation()
{
	if ( !wp_next_scheduled('actify_gforms_cleanup_event') )
	{
		wp_schedule_event(current_time('timestamp'), 'daily', 'actify_gforms_cleanup_event');
	}
}
add_action('wp', 'actify_gforms_cleanup_event_activation');
add_action('actify_gforms_cleanup_event', 'actify_gforms_cleanup_temp_files');




/**** Specific Form Functions ****/




/**** SpinFire Professional Trial ****/

// Handle the SpinFire Professional Trial form license request and confirmation message
add_filter('gform_confirmation_1', 'actify_do_spinfire_professional_trial_license_request_and_set_confirmation', 10, 4);
function actify_do_spinfire_professional_trial_license_request_and_set_confirmation($confirmation, $form, $lead, $ajax)
{
	// Check if they want to download the software or request a CD
	if ($lead['9'] == 'Download')
	{
		// Do a license request
		$license_request_url = actify_get_trial_license_request_url($lead['1'], 
																	$lead['2'],
																	$lead['3.3'], $lead['3.6'], 
																	$lead['4'], 
																	$lead['5'],
																	$lead['6'],
																	$lead['7.1'], $lead['7.2'], $lead['7.3'], $lead['7.4'], $lead['7.5'], $lead['7.6'],
																	'',
																	$lead['8']);
		
		$result_string = file_get_contents($license_request_url);
		$message = "RESULT STRING = " . $result_string;
        send_to_log($message, "forms.php - actify_do_spinfire_professional_trial_license_request_and_set_confirmation");

		if ($result_string == 'Problem with license server')
		{
			$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
		}
		else if ($result_string == 'Not a new user')
		{
			$confirmation = '<span class="error">' . __('Our records indicate that you have already requested a trial using this email address. Please contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
		}
		else if (substr_count($result_string,"Fatal error") >= 1)
		{
				// Display Message that there is a form erro)
				$confirmation = '<span class="error">' . __('We apologize for the inconvenience but we are currently having technical issues with our download forms. If you would like to request a trial of SpinFire please contact us at ', 'actify') . ' <a href="mailto:sales@actify.com?subject=Spinfire Trial Request From Failed Form Submission">sales@actify.com</a></span>';
		}
		else
		{
			// Send the license email
		
			$seat_license_xml = new SimpleXMLElement($result_string);

			$lead_id = (string)$seat_license_xml->lead_id;
			$seat_id = (string)$seat_license_xml->seat_id;
			
			$email_language = actify_get_email_language_code($lead['1']);
		
			require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/get_sfp_trial_email_subject_and_body.php');
			list($subject, $body) = get_sfp_trial_email_subject_and_body($seat_id);

			actify_send_license_email($lead_id, $lead['6'], $subject, $body);
			// Redirect to SpinFire Professional Trial Thank You page
			$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));
		}
	}
	// CD
	else
	{
		// Submit the lead to Salesforce
		
		// Build the Salesforce lead
		$salesforce_lead = array();
		$salesforce_lead['Language__c'] = $lead['1'];
		$salesforce_lead['Salutation'] = $lead['2'];
		$salesforce_lead['FirstName'] = $lead['3.3'];
		$salesforce_lead['LastName'] = $lead['3.6'];
		$salesforce_lead['Company'] = $lead['4'];
		$salesforce_lead['Phone'] = $lead['5'];
		$salesforce_lead['Email'] = $lead['6'];
		$salesforce_lead['Street'] = trim($lead['7.1'] . ' ' . $lead['7.2']);
		$salesforce_lead['City'] = $lead['7.3'];
		$salesforce_lead['State'] = $lead['7.4'];
		$salesforce_lead['PostalCode'] = $lead['7.5'];
		$salesforce_lead['Country'] = $lead['7.6'];
		$salesforce_lead['Product_Interest__c'] = 'SpinFire Professional 10 CD Request';
		
		// Submit to Salesforce
		actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['8']));	
		
		$confirmation = __('Thank you for your request for a copy of our SpinFire Professional Trial. Your request is being processed and you will receive your CD in the mail shortly.', 'actify');
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Trial form is submitted
add_action('gform_after_submission_1', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Professional Trial form
add_action('gform_after_submission_1', 'actify_save_form_field_values_1', 10, 2);
function actify_save_form_field_values_1($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['2'];
	$field_values['first_name'] = $lead['3.3'];
	$field_values['last_name'] = $lead['3.6'];
	$field_values['company'] = $lead['4'];
	$field_values['phone'] = $lead['5'];
	$field_values['email'] = $lead['6'];
	$field_values['street1'] = $lead['7.1'];
	$field_values['street2'] = $lead['7.2'];
	$field_values['city'] = $lead['7.3'];
	$field_values['state'] = $lead['7.4'];
	$field_values['zip_code'] = $lead['7.5'];
	$field_values['country'] = $lead['7.6'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Upgrade ****/

// Handle the SpinFire Upgrade form license request and confirmation message
add_filter('gform_confirmation_2', 'actify_do_spinfire_upgrade_license_request_and_set_confirmation', 10, 4);
function actify_do_spinfire_upgrade_license_request_and_set_confirmation($confirmation, $form, $lead, $ajax)
{
	// Do a license request
	
	$license_request_url = actify_get_upgrade_license_request_url($lead['7'],
																$lead['1'], 
																$lead['2.3'], $lead['2.6'], 
																$lead['3'], 
																$lead['4'],
																$lead['5'],
																$lead['6.1'], $lead['6.2'], $lead['6.3'], $lead['6.4'], $lead['6.5'], $lead['6.6']);
	
	$result_string = file_get_contents($license_request_url);

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else if ($result_string == 'Invalid server name specified for floating license')
	{
		$confirmation = '<span class="error">' . __('We regret to inform you that there is an error in the SeatID you entered . An invalid server name has been specified.', 'actify') . '<a href="mailto:sales@actify.com?subject=Invalid Server Name Specified">' . __('Please contact us to verify license details.', 'actify') . '</a></span>';
	}
	else if ($result_string == 'Out of maintenance')
	{
		$confirmation = '<span class="error">' . __('We regret to inform you that your SeatID is not within maintenance. Please contact your local Reseller immediately or <a href="mailto:sales@actify.com">sales@actify.com</a> in order to renew your maintenance and gain access to the newest version of SpinFire Professional and its many added benefits.', 'actify') . '</span>';
	}
	else if ($result_string == 'Not an SFP user')
	{
		$confirmation = '<span class="error">' . __('We regret to inform you that the SeatID you entered is not a valid SpinFire Professional SeatID. Please try entering the SeatID again or contact your local Reseller immediately for assistance in order to gain access to the newest version of SpinFire Professional and its many added benefits.', 'actify') . '</span>';
	}
	else
	{
		// Send the license email
	
		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		$language = (string)$seat_license_xml->language;
		$license = base64_decode((string)$seat_license_xml->license);
		$floating_license = (string)$seat_license_xml->floating_license;

		if ($floating_license == '')
		{
			$floating_license = NULL;
		}
		
		require_once(get_stylesheet_directory() . '/emails/' . ICL_LANGUAGE_CODE . '/get_sf_upgrade_email_subject_and_body.php');
		list($subject, $body) = get_sf_upgrade_email_subject_and_body();

		$this->send_email($lead_id, $crm_form->get_email(), $subject, $body, $license, $floating_license);
		
		$confirmation = array('redirect' => get_permalink( icl_object_id(1868, 'page', true) ));
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Upgrade form is submitted
add_action('gform_after_submission_2', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Professional Upgrade form
add_action('gform_after_submission_2', 'actify_save_form_field_values_2', 10, 2);
function actify_save_form_field_values_2($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['1'];
	$field_values['first_name'] = $lead['2.3'];
	$field_values['last_name'] = $lead['2.6'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	$field_values['street1'] = $lead['6.1'];
	$field_values['street2'] = $lead['6.2'];
	$field_values['city'] = $lead['6.3'];
	$field_values['state'] = $lead['6.4'];
	$field_values['zip_code'] = $lead['6.5'];
	$field_values['country'] = $lead['6.6'];
	
	actify_save_form_field_values($field_values);
}




/**** White Papers ****/

// Submits White Papers form data to Salesforce
add_action('gform_after_submission_3', 'actify_process_multiple_white_papers_form', 10, 2);
function actify_process_multiple_white_papers_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['Salutation'] = $lead['1'];
	$salesforce_lead['FirstName'] = $lead['2.3'];
	$salesforce_lead['LastName'] = $lead['2.6'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Phone'] = $lead['4'];
	$salesforce_lead['Email'] = $lead['5'];
	$salesforce_lead['Street'] = trim($lead['6.1'] . ' ' . $lead['6.2']);
	$salesforce_lead['City'] = $lead['6.3'];
	$salesforce_lead['State'] = $lead['6.4'];
	$salesforce_lead['PostalCode'] = $lead['6.5'];
	$salesforce_lead['Country'] = $lead['6.6'];
	$salesforce_lead['Product_Interest__c'] = $lead['8'];
	
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['7']));
}

// Delete leads after White Papers form is submitted
add_action('gform_after_submission_3', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the White Papers form
add_action('gform_after_submission_3', 'actify_save_form_field_values_3', 10, 2);
function actify_save_form_field_values_3($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['1'];
	$field_values['first_name'] = $lead['2.3'];
	$field_values['last_name'] = $lead['2.6'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	$field_values['street1'] = $lead['6.1'];
	$field_values['street2'] = $lead['6.2'];
	$field_values['city'] = $lead['6.3'];
	$field_values['state'] = $lead['6.4'];
	$field_values['zip_code'] = $lead['6.5'];
	$field_values['country'] = $lead['6.6'];
	
	actify_save_form_field_values($field_values);
}




/**** Locate a Reseller ****/

// Delete leads after Locate a Reseller form is submitted
add_action('gform_after_submission_4', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the Locate a Reseller form
add_action('gform_after_submission_4', 'actify_save_form_field_values_4', 10, 2);
function actify_save_form_field_values_4($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['company'] = $lead['2'];
	$field_values['title'] = $lead['3'];
	$field_values['phone'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	$field_values['street1'] = $lead['6.1'];
	$field_values['street2'] = $lead['6.2'];
	$field_values['city'] = $lead['6.3'];
	$field_values['state'] = $lead['6.4'];
	$field_values['zip_code'] = $lead['6.5'];
	$field_values['country'] = $lead['6.6'];
	
	actify_save_form_field_values($field_values);
}




/**** Generic Product Interest ****/

// Submits Generic Product Interest form data to Salesforce
add_action('gform_after_submission_5', 'actify_process_generic_product_interest_form', 10, 2);
function actify_process_generic_product_interest_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['Salutation'] = $lead['1'];
	$salesforce_lead['FirstName'] = $lead['2.3'];
	$salesforce_lead['LastName'] = $lead['2.6'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Phone'] = $lead['4'];
	$salesforce_lead['Email'] = $lead['5'];
	$salesforce_lead['Street'] = trim($lead['6.1'] . ' ' . $lead['6.2']);
	$salesforce_lead['City'] = $lead['6.3'];
	$salesforce_lead['State'] = $lead['6.4'];
	$salesforce_lead['PostalCode'] = $lead['6.5'];
	$salesforce_lead['Country'] = $lead['6.6'];
	$salesforce_lead['Product_Interest__c'] = $lead['8'];
	
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['7']));
}

// Delete leads after Generic Product Interest form is submitted
add_action('gform_after_submission_5', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Sets the Generic Product Interest form confirmation message/redirect
add_filter('gform_confirmation_5', 'actify_set_generic_product_interest_form_confirmation', 10, 4);
function actify_set_generic_product_interest_form_confirmation($confirmation, $form, $lead, $ajax)
{
	return actify_set_dynamic_confirmation_message($lead['9']);
}

// Save field values for the Generic Product Interest form
add_action('gform_after_submission_5', 'actify_save_form_field_values_5', 10, 2);
function actify_save_form_field_values_5($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['1'];
	$field_values['first_name'] = $lead['2.3'];
	$field_values['last_name'] = $lead['2.6'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	$field_values['street1'] = $lead['6.1'];
	$field_values['street2'] = $lead['6.2'];
	$field_values['city'] = $lead['6.3'];
	$field_values['state'] = $lead['6.4'];
	$field_values['zip_code'] = $lead['6.5'];
	$field_values['country'] = $lead['6.6'];
	
	actify_save_form_field_values($field_values);
}




/**** Request a PDI Assessment ****/

// Delete leads after Request a PDI Assessment form is submitted
add_action('gform_after_submission_7', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Submits Request a PDI Assessment form data to Salesforce
add_action('gform_after_submission_7', 'actify_process_request_pdi_assessment_form', 10, 2);
function actify_process_request_pdi_assessment_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['Salutation'] = $lead['1'];
	$salesforce_lead['FirstName'] = $lead['2.3'];
	$salesforce_lead['LastName'] = $lead['2.6'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Title'] = $lead['4'];
	$salesforce_lead['Email'] = $lead['5'];
	$salesforce_lead['Phone'] = $lead['9'];
	$salesforce_lead['Street'] = trim($lead['6.1'] . ' ' . $lead['6.2']);
	$salesforce_lead['City'] = $lead['6.3'];
	$salesforce_lead['State'] = $lead['6.4'];
	$salesforce_lead['PostalCode'] = $lead['6.5'];
	$salesforce_lead['Country'] = $lead['6.6'];
	$salesforce_lead['Comments__c'] = $lead['7'];
	$salesforce_lead['Product_Interest__c'] = 'PDI Assessment Request';
	
	$message = "LEAD VAR = \n ";
	var_log($lead, "LEAD", "actify_process_request_pdi_assessment_form");
	var_log($salesforce_lead, "SALESFORCE_LEAD", "forms.php - actify_process_request_pdi_assessment_form");
	
	$message = "salesforce_lead <b>CampaignId</b>: " . $lead['8'];
	send_to_log($message, "forms.php - actify_process_request_pdi_assessment_form");
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['8']));
}

// Save field values for the Request a PDI Assessment form
add_action('gform_after_submission_7', 'actify_save_form_field_values_7', 10, 2);
function actify_save_form_field_values_7($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['1'];
	$field_values['first_name'] = $lead['2.3'];
	$field_values['last_name'] = $lead['2.6'];
	$field_values['company'] = $lead['3'];
	$field_values['title'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	$field_values['phone'] = $lead['9'];
	$field_values['street1'] = $lead['6.1'];
	$field_values['street2'] = $lead['6.2'];
	$field_values['city'] = $lead['6.3'];
	$field_values['state'] = $lead['6.4'];
	$field_values['zip_code'] = $lead['6.5'];
	$field_values['country'] = $lead['6.6'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Feedback ****/

// Delete leads after SpinFire Feedback form is submitted
add_action('gform_after_submission_8', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Feedback form
add_action('gform_after_submission_8', 'actify_save_form_field_values_8', 10, 2);
function actify_save_form_field_values_8($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Issue ****/

// Attach the uploaded file to SpinFire Issues notification emails
// http://www.gravityhelp.com/documentation/page/Gform_notification#Example_5
add_filter('gform_notification_9', 'attach_issue_file', 10, 3);
function attach_issue_file($notification, $form, $entry)
{
	//There is no concept of user notifications anymore, so we will need to target notifications based on other criteria, such as name
    if($notification["toType"] == "email"){

        $fileupload_fields = GFCommon::get_fields_by_type($form, array("fileupload"));

        if(!is_array($fileupload_fields))
            return $notification;

        $attachments = array();
        $upload_root = RGFormsModel::get_upload_root();
        foreach($fileupload_fields as $field)
		{
            $url = $entry[$field["id"]];
            $attachment = preg_replace('|^(.*?)/gravity_forms/|', $upload_root, $url);
            if($attachment){
                $attachments[] = $attachment;
            }
        }
        $notification["attachments"] = $attachments;
    }

    return $notification;
}

// Delete leads after SpinFire Issue form is submitted
add_action('gform_after_submission_9', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Issue form
add_action('gform_after_submission_9', 'actify_save_form_field_values_9', 10, 2);
function actify_save_form_field_values_9($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Program Application ****/

// Delete leads after SpinFire Program Application form is submitted
add_action('gform_after_submission_10', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Program Application form
add_action('gform_after_submission_10', 'actify_save_form_field_values_10', 10, 2);
function actify_save_form_field_values_10($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	
	actify_save_form_field_values($field_values);
}




/**** Open House ****/

// Delete leads after Open House form is submitted
add_action('gform_after_submission_14', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Submits Open House form data to Salesforce
add_action('gform_after_submission_14', 'actify_process_open_house_form', 10, 2);
function actify_process_open_house_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['Salutation'] = '';
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Phone'] = $lead['4'];
	$salesforce_lead['Email'] = $lead['5'];
	$salesforce_lead['Street'] = '';
	$salesforce_lead['City'] = '';
	$salesforce_lead['State'] = '';
	$salesforce_lead['PostalCode'] = '';
	$salesforce_lead['Country'] = 'USA';
	$salesforce_lead['Product_Interest__c'] = 'Actify Open House';
	$salesforce_lead['Comments__c'] = 'Number of Guests: ' . $lead['6'] . "\nGuest Names: \n" . $lead['7'];
	
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['8']));
}

// Save field values for the Open House form
add_action('gform_after_submission_14', 'actify_save_form_field_values_14', 10, 2);
function actify_save_form_field_values_14($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['title'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['4'];
	$field_values['email'] = $lead['5'];
	
	actify_save_form_field_values($field_values);
}




/**** Request a SpinFire Quote ****/

// Lookup existing contact info from Salesforce when handling a Request a SpinFire Quote request
add_action("gform_pre_submission_15", "actify_get_request_a_spinfire_quote_form_info_from_salesforce");
function actify_get_request_a_spinfire_quote_form_info_from_salesforce($form)
{
	require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'actify_specific' . DIRECTORY_SEPARATOR . 'login_to_salesforce.php');
	$salesforce_handle = login_to_salesforce();
	
	$search_result = $salesforce_handle->search('FIND {' . escape_salesforce_characters($_POST['input_1']) . '} IN EMAIL FIELDS RETURNING Contact (Id, Salutation, Name, Phone, Regional_Sales_Manager__c) LIMIT 1');
	
	// Check if we found a result
	if (isset($search_result->searchRecords))
	{
		// Regional Sales Manager
		$_POST['input_7'] = $search_result->searchRecords->record->Regional_Sales_Manager__c;
		// Salesforce URL
		$_POST['input_8'] = 'https://login.salesforce.com/' . $search_result->searchRecords->record->Id;
		
		if ($_POST['input_12'] == '')
		{
			// Phone
			$_POST['input_12'] = $search_result->searchRecords->record->Phone;
		}
	}
}

// Delete leads after Request a SpinFire Quote form is submitted
add_action('gform_after_submission_15', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Submits Request a SpinFire Quote form data to Salesforce
add_action('gform_after_submission_15', 'actify_process_request_a_spinfire_quote_form', 10, 2);
function actify_process_request_a_spinfire_quote_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['14.3'];
	$salesforce_lead['LastName'] = $lead['14.6'];
	$salesforce_lead['Email'] = $lead['1'];
	$salesforce_lead['Company'] = $lead['11'];
	$salesforce_lead['Phone'] = $lead['12'];
	$salesforce_lead['Country'] = $lead['13'];
	$salesforce_lead['Product_Interest__c'] = 'SpinFire RFQ';
	
	// Build attachment
	$attachment = '';
	
	$attachment .= "License: " . $lead['2'];
	$attachment .= "\n\n# Licenses: " . $lead['3'];
	
	// File Types checkboxes
	$attachment .= "\n\nFile Types: ";
	for ($i = 1; $i <= 100; $i++)
	{
		// Multiples of 10 are not included in the indexes
		if ($i % 10 == 0)
		{
			continue;
		}
		
		if (array_key_exists("4.$i", $lead))
		{
			if ($lead["4.$i"] != '')
			{
				$attachment .= "\n - " . $lead["4.$i"];
			}
		}
		else
		{
			// No more indexes
			break;
		}
	}
	
	// Add-ins checkboxes
	$attachment .= "\n\nAdd-ins: ";
	for ($i = 1; $i <= 100; $i++)
	{
		// Multiples of 10 are not included in the indexes
		if ($i % 10 == 0)
		{
			continue;
		}
		
		if (array_key_exists("10.$i", $lead))
		{
			if ($lead["10.$i"] != '')
			{
				$attachment .= "\n - " . $lead["10.$i"];
			}
		}
		else
		{
			// No more indexes
			break;
		}
	}
	
	$attachment .= "\n\nComments: \n" . $lead['5'];
	
	$encoded_attachment = base64_encode($attachment);
	
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead, array(), array('SFP_RFQ.txt' => $encoded_attachment));
}

// Save field values for the Request a SpinFire Quote form
add_action('gform_after_submission_15', 'actify_save_form_field_values_15', 10, 2);
function actify_save_form_field_values_15($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['14.3'];
	$field_values['last_name'] = $lead['14.6'];
	$field_values['email'] = $lead['1'];
	$field_values['company'] = $lead['11'];
	$field_values['phone'] = $lead['12'];
	$field_values['country'] = $lead['13'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Ultimate Trial - OLD x 2 ****/

// Submits SpinFire Ultimate Trial form data to Salesforce
/*add_action('gform_validation_16', 'actify_validate_spinfire_ultimate_trial_form', 10, 1);
function actify_validate_spinfire_ultimate_trial_form($validation_result)
{	
	// Get the form object from the validation result
    $form = $validation_result['form'];
	
	foreach($form['fields'] as &$field)
	{
		// Match the email field by custom CSS class
		if($field['cssClass'] == 'actify-gforms-validate-corporate-email')
		{
			$field_value = rgpost("input_{$field['id']}");

			// Check if the email is not from Gmail, Hotmail or Yahoo
			if (preg_match('/@(gmail|hotmail|yahoo)\..+$/i', $field_value))
			{
				// The field failed validation, so first we'll need to fail the validation for the entire form
				$validation_result['is_valid'] = false;

				// Next we'll mark the specific field that failed and add a custom validation message
				$field['failed_validation'] = true;
				$field['validation_message'] = 'We apologize, but a valid company email address is required. Please try again.';
			}
		}
	}
	
	 // Assign our (potentially) modified $form object back to the validation result
    $validation_result['form'] = $form;
	
	return $validation_result;
}

// Submits SpinFire Ultimate Trial form data to Salesforce
add_action('gform_after_submission_16', 'actify_process_spinfire_ultimate_trial_form', 10, 2);
function actify_process_spinfire_ultimate_trial_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Email'] = $lead['2'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Company_Size__c'] = $lead['4'];
	$salesforce_lead['Phone'] = $lead['5'];
	$salesforce_lead['Country'] = $lead['6'];
	
	if ($lead['7'] == 'Yes')
	{
		$salesforce_lead['Account_Type__c'] = 'Direct Customer';
	}
	else
	{
		$salesforce_lead['Account_Type__c'] = 'Direct Prospect';
	}
	
	$salesforce_lead['Seat_ID__c'] = $lead['8'];
	$salesforce_lead['Language__c'] = $lead['9'];
	$salesforce_lead['Comments__c'] = $lead['10'];
	$salesforce_lead['Product_Interest__c'] = 'SpinFire Ultimate Request';
	
	// Submit to Salesforce
	actify_submit_lead_to_salesforce($salesforce_lead);
}

// Delete leads after SpinFire Ultimate Trial form is submitted
add_action('gform_after_submission_16', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Trial form
add_action('gform_after_submission_16', 'actify_save_form_field_values_16', 10, 2);
function actify_save_form_field_values_16($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['5'];
	$field_values['country'] = $lead['6'];
	
	actify_save_form_field_values($field_values);
}*/




/**** SpinFire Ultimate Trial - OLD x 1 ****/

// Handle the SpinFire Ultimate Trial form license request and confirmation message
add_filter('gform_confirmation_17', 'actify_process_spinfire_ultimate_trial_form2', 10, 4);
function actify_process_spinfire_ultimate_trial_form2($confirmation, $form, $lead, $ajax)
{
	$thank_you_page_id = 11441;
	$upgrade_thank_you_page_id = 11587;
	$outofmaintenance_thank_you_page_id = 11588;
	$error_confirmation_message = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	
	// Check if they are already a customer
	if ($lead['7'] == 'Yes')
	{
		$seat_id = $lead['8'];
		
		// Try to update seat to spinfire 11
		$result_xml_string = file_get_contents('http://lm2.actify.com/LicenseManager2/LMCommerce.asmx/UpgradeToSF11?keycode=XXXXXXXXXXXX&seatid=' . rawurlencode($seat_id));
		
		if (!$result_xml_string)
		{
			// Problem with license server
			$confirmation = $error_confirmation_message;
		}
		
		$result_xml = new SimpleXMLElement($result_xml_string);
		
		if (!$result_xml)
		{
			// Problem with license server
			$confirmation = $error_confirmation_message;
		}
		
		if ((string)$result_xml->Success == 'true' || (string)$result_xml->UserMessage == "It's already SpinFire 11 license!")
		{
			// Submit to salesforce
			$lead_id = actify_process_spinfire_ultimate_trial_form2_salesforce_helper($lead, 'SpinFire Ultimate Upgrade', (string)$result_xml->Eom);
			
			/*
			// Send success email
			
			// Get the email to send to
			require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
			list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
			
			$email_language = actify_get_email_language_code($lead['9']);
			require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_upgrade_email_subject_and_body.php');
			list($subject, $body) = get_sfu_upgrade_email_subject_and_body((string)$result_xml->Eom, $lead);
			require_once(get_stylesheet_directory() . '/emails/send_email.php');
			send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
			*/
			
			// Redirect to Upgrade Thank You page
			$confirmation = array('redirect' => get_permalink( icl_object_id($upgrade_thank_you_page_id, 'page', true) ));
		}
		else if ($result_xml->UserMessage == 'Invalid SeatId')
		{
			// Do a trial license request
			$confirmation = actify_process_spinfire_ultimate_trial_form2_license_request_helper($lead, $outofmaintenance_thank_you_page_id, 'SpinFire Ultimate Trial EOM', true);
		}
		else if ($result_xml->UserMessage == 'License is out of maintenance')
		{
			// Do a trial license request
			$confirmation = actify_process_spinfire_ultimate_trial_form2_license_request_helper($lead, $outofmaintenance_thank_you_page_id, 'SpinFire Ultimate Trial EOM', true);
		}
	}
	else
	{
		// Do a trial license request
		$confirmation = actify_process_spinfire_ultimate_trial_form2_license_request_helper($lead, $thank_you_page_id, 'SpinFire Ultimate Trial', false);
	}
	
	return $confirmation;
}

function actify_process_spinfire_ultimate_trial_form2_license_request_helper($lead, $thank_you_page_id, $product_interest, $use_out_of_maintenance_email)
{
	// Do a license request
	$license_request_url = actify_get_trial_license_request_url($lead['9'], 
																'',
																$lead['1.3'], $lead['1.6'], 
																$lead['3'], 
																$lead['5'],
																$lead['2'],
																'', '', '', '', '', $lead['6'],
																$lead['10'],
																'701D00000013BSt',
																$product_interest,
																11);
	
	$result_string = file_get_contents($license_request_url);

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else
	{
		/*
		// Send the license email

		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
	
		if ($use_out_of_maintenance_email)
		{
			require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_outofmaintenance_email_subject_and_body.php');
			list($subject, $body) = get_sfu_outofmaintenance_email_subject_and_body($seat_id, $lead);
		}
		else
		{
			require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
			list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id, $lead);
		}

		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		*/
		
		// Redirect to SpinFire Ultimate Trial Thank You page
		$confirmation = array('redirect' => get_permalink( icl_object_id($thank_you_page_id, 'page', true) ));
	}
	
	return $confirmation;
}

function actify_process_spinfire_ultimate_trial_form2_salesforce_helper($lead, $product_interest, $eom_date = null)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Email'] = $lead['2'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Company_Size__c'] = $lead['4'];
	$salesforce_lead['Phone'] = $lead['5'];
	$salesforce_lead['Country'] = $lead['6'];
	
	if ($lead['7'] == 'Yes')
	{
		$salesforce_lead['Account_Type__c'] = 'Direct Customer';
	}
	else
	{
		$salesforce_lead['Account_Type__c'] = 'Direct Prospect';
	}
	
	$salesforce_lead['Seat_ID__c'] = $lead['8'];
	$salesforce_lead['Language__c'] = $lead['9'];
	$salesforce_lead['Comments__c'] = $lead['10'];
	$salesforce_lead['Product_Interest__c'] = $product_interest;
	
	if ($eom_date)
	{
		$salesforce_lead['EOM_Date__c'] = $eom_date;
	}
	
	// Submit to Salesforce (add to Ultimate Lead campaign)
	return actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => '701D00000013BSt'));
}

// Delete leads after SpinFire Ultimate Trial form is submitted
add_action('gform_after_submission_17', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Trial form
add_action('gform_after_submission_17', 'actify_save_form_field_values_17', 10, 2);
function actify_save_form_field_values_17($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['5'];
	$field_values['country'] = $lead['6'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Professional Trial Mini ****/

// Handle the SpinFire Professional Trial Mini form license request and confirmation message
add_filter('gform_confirmation_18', 'actify_do_spinfire_professional_trial_mini_license_request_and_set_confirmation', 10, 4);
function actify_do_spinfire_professional_trial_mini_license_request_and_set_confirmation($confirmation, $form, $lead, $ajax)
{
	// Do a license request
	$license_request_url = actify_get_trial_license_request_url($lead['1'], 
																'',
																$lead['2.3'], $lead['2.6'], 
																$lead['3'], 
																'',
																$lead['4'],
																'', '', '', '', '', $lead['5'],
																'',
																$lead['6']
																);
	
	$result_string = file_get_contents($license_request_url);

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else if ($result_string == 'Not a new user')
	{
		$confirmation = '<span class="error">' . __('Our records indicate that you have already requested a trial using this email address. Please contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else
	{
		// Send the license email
	
		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		$email_language = actify_get_email_language_code($lead['1']);
	
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/get_sfp_trial_email_subject_and_body.php');
		list($subject, $body) = get_sfp_trial_email_subject_and_body($seat_id);

		actify_send_license_email($lead_id, $lead['4'], $subject, $body);
		// Redirect to SpinFire Professional Trial Thank You page
		$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Trial Mini form is submitted
add_action('gform_after_submission_18', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Professional Trial Mini form
add_action('gform_after_submission_18', 'actify_save_form_field_values_18', 10, 2);
function actify_save_form_field_values_18($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['2.3'];
	$field_values['last_name'] = $lead['2.6'];
	$field_values['company'] = $lead['3'];
	$field_values['email'] = $lead['4'];
	$field_values['country'] = $lead['5'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Ultimate Trial - NEW ****/
// FORM 19 STARTS HERE
// Handle the SpinFire Ultimate Trial form license request and confirmation message
add_filter('gform_confirmation_19', 'actify_process_spinfire_ultimate_trial_form3', 10, 4);
function actify_process_spinfire_ultimate_trial_form3($confirmation, $form, $lead, $ajax)
{
	$thank_you_page_id = 11441;
	$error_confirmation_message = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	
	// Do a trial license request
	$license_request_url = actify_get_trial_license_request_url($lead['9'], 
																'',
																$lead['1.3'], $lead['1.6'], 
																$lead['3'], 
																$lead['5'],
																$lead['2'],
																'', '', '', '', '', $lead['6'],
																$lead['10'],
																'701D00000013BSt',
																'SpinFire Ultimate Trial',
																11,
																$lead['4']);
	
	$result_string = file_get_contents($license_request_url);

	$message = "SPINFIRE ULTIMATE RESULT STRING = " . $result_string;
        send_to_log($message,"forms.php - actify_process_spinfire_ultimate_trial_form3");

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else
	{
		/*
		// Send the license email
		
		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
	
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
		list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id, $lead);

		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		*/
		
		// Redirect to SpinFire Ultimate Trial Thank You page
		$confirmation = array('redirect' => get_permalink( icl_object_id($thank_you_page_id, 'page', true) ));
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Ultimate Trial form is submitted
add_action('gform_after_submission_19', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Trial form
add_action('gform_after_submission_19', 'actify_save_form_field_values_19', 10, 2);
function actify_save_form_field_values_19($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['5'];
	$field_values['country'] = $lead['6'];
	
	actify_save_form_field_values($field_values);
}




/**** SpinFire Ultimate Upgrade ****/

// Handle the SpinFire Ultimate Upgrade form license request and confirmation message
add_filter('gform_confirmation_20', 'actify_process_spinfire_ultimate_upgrade_form', 10, 4);
function actify_process_spinfire_ultimate_upgrade_form($confirmation, $form, $lead, $ajax)
{
	$upgrade_thank_you_page_id = 11587;
	$outofmaintenance_thank_you_page_id = 11588;
	$invalidseatid_thank_you_page_id = 12140;
	$error_confirmation_message = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	
	$seat_id = $lead['8'];
	
	// Try to update seat to spinfire 11
	$result_xml_string = file_get_contents('http://lm2.actify.com/LicenseManager2/LMCommerce.asmx/UpgradeToSF11?keycode=XXXXXXXXXXXX&seatid=' . rawurlencode($seat_id));
	
	if (!$result_xml_string)
	{
		// Problem with license server
		$confirmation = $error_confirmation_message;
	}
	
	$result_xml = new SimpleXMLElement($result_xml_string);
	
	if (!$result_xml)
	{
		// Problem with license server
		$confirmation = $error_confirmation_message;
	}
	
	if ((string)$result_xml->Success == 'true' || (string)$result_xml->UserMessage == "It's already SpinFire 11 license!")
	{
		$eom_date = (string)$result_xml->Eom;
		
		if ((int)$result_xml->NumFloatingSeats > 0)
		{
			$license_type = 'Floating';
		}
		else
		{
			$license_type = 'Fixed';
		}
		
		$product_interest = 'SpinFire Ultimate Upgrade';
		
		// Build the Salesforce lead
		$salesforce_lead = array();
		$salesforce_lead['FirstName'] = $lead['1.3'];
		$salesforce_lead['LastName'] = $lead['1.6'];
		$salesforce_lead['Email'] = $lead['2'];
		$salesforce_lead['Company'] = $lead['3'];
		$salesforce_lead['Company_Size__c'] = $lead['4'];
		$salesforce_lead['Phone'] = $lead['5'];
		$salesforce_lead['Country'] = $lead['6'];
		$salesforce_lead['Account_Type__c'] = 'Direct Customer';
		$salesforce_lead['Seat_ID__c'] = $lead['8'];
		$salesforce_lead['Language__c'] = $lead['9'];
		$salesforce_lead['Comments__c'] = $lead['10'];
		$salesforce_lead['Product_Interest__c'] = $product_interest;
		$salesforce_lead['EOM_Date__c'] = $eom_date;
		$salesforce_lead['License_Type__c'] = $license_type;
		
		// Build the Salesforce campaign member
		$salesforce_campaign_member = array();
		$salesforce_campaign_member['CampaignId'] = '701D00000013BSt';
		$salesforce_campaign_member['Seat_ID__c'] = $lead['8'];
		$salesforce_campaign_member['Language__c'] = $lead['9'];
		$salesforce_campaign_member['License_Type__c'] = $license_type;
		$salesforce_campaign_member['Product_Interest__c'] = $product_interest;
		$salesforce_campaign_member['EOM_Date__c'] = $eom_date;
		
		// Submit to Salesforce (add to Ultimate Lead campaign)
		actify_submit_lead_to_salesforce($salesforce_lead, $salesforce_campaign_member);
		
		/*
		// Send success email
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_upgrade_email_subject_and_body.php');
		list($subject, $body) = get_sfu_upgrade_email_subject_and_body((string)$result_xml->Eom, $lead);
		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		*/
		
		// Redirect to Upgrade Thank You page
		$confirmation = array('redirect' => get_permalink( icl_object_id($upgrade_thank_you_page_id, 'page', true) ));
	}
	else if ((string)$result_xml->UserMessage == 'License is out of maintenance')
	{
		$eom_date = (string)$result_xml->Eom;
		
		// Do a trial license request
		$confirmation = actify_process_spinfire_ultimate_upgrade_form_license_request_helper($lead, $outofmaintenance_thank_you_page_id, $eom_date);
	}
	else if ((string)$result_xml->UserMessage == 'Invalid SeatId' || (string)$result_xml->UserMessage == 'The seat does not exist')
	{
		// Redirect to invalid seat ID page
		$confirmation = array('redirect' => get_permalink( icl_object_id($invalidseatid_thank_you_page_id, 'page', true) ));
	}
	
	
	return $confirmation;
}

function actify_process_spinfire_ultimate_upgrade_form_license_request_helper($lead, $thank_you_page_id, $eom_date = null)
{
	// Do a license request
	$license_request_url = actify_get_trial_license_request_url($lead['9'], 
																'',
																$lead['1.3'], $lead['1.6'], 
																$lead['3'], 
																$lead['5'],
																$lead['2'],
																'', '', '', '', '', $lead['6'],
																$lead['10'],
																'701D00000013BSt',
																'SpinFire Ultimate Trial EOM',
																11,
																$lead['4'],
																$lead['8'],
																$eom_date,
																$lead['11']);
	
	$result_string = file_get_contents($license_request_url);

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}
	else
	{
		/*
		// Send the license email
		
		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
	
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_outofmaintenance_email_subject_and_body.php');
		list($subject, $body) = get_sfu_outofmaintenance_email_subject_and_body($seat_id, $lead);
		
		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		*/
		
		// Redirect to SpinFire Ultimate Trial Thank You page
		$confirmation = array('redirect' => get_permalink( icl_object_id($thank_you_page_id, 'page', true) ));
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Ultimate Upgrade form is submitted
add_action('gform_after_submission_20', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Upgrade form
add_action('gform_after_submission_20', 'actify_save_form_field_values_20', 10, 2);
function actify_save_form_field_values_20($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['phone'] = $lead['5'];
	$field_values['country'] = $lead['6'];
	
	actify_save_form_field_values($field_values);
}

/**** SpinFire Ultimate Trial - NEW ****/
// FORM _21 STARTS HERE
// Handle the SpinFire Ultimate Trial form license request and confirmation message

add_filter('gform_confirmation_21', 'actify_process_spinfire_ultimate_trial_form4', 10, 4);
function actify_process_spinfire_ultimate_trial_form4($confirmation, $form, $lead, $ajax)
{
	$thank_you_page_id = 11441;
	$error_confirmation_message = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	
	// Do a trial license request
	// Build the Salesforce lead

/*
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Title'] = "";
	$salesforce_lead['Email'] = $lead['2'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Company_Size__c'] = "";
	$salesforce_lead['City'] = $lead['11.3'];
	$salesforce_lead['Country'] = $lead['11.6'];
	$salesforce_lead['Phone'] = $lead['5'];
	$salesforce_lead['Comments__c'] = $lead['10'];
	$salesforce_lead['Product_Interest__c'] = "'SpinFire Ultimate Trial'";
*/	
	var_log($lead, "LEAD", "forms.php - actify_process_spinfire_ultimate_trial_form4");
	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4");
	$license_request_url = actify_get_trial_license_request_url(
$lead['9'],  //Language
'',  //Salutation
$lead['1.3'],  //FirstName 
$lead['1.6'],  //LastName
$lead['3'],  //Company
$lead['5'],  //Phone
$lead['2'],   //Email
'', //Street
'', //Street
$lead['11.3'],  //City
'', //State
'', //Zip
$lead['11.6'],  //Country
$lead['10'], //Comments
'701D00000013BSt', //campaign_id
'SpinFire Ultimate Trial',  //Product_Interest__c
11, //Version
'',  		//Company Size
$lead['12'],   //Title
$lead['6'], //EOM Date,
$lead['4']); //License Type
	
	$message =  "LICENSE REQUEST URL = " .$license_request_url;
	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4");

	$result_string = file_get_contents($license_request_url);

	$message = "SPINFIRE ULTIMATE RESULT STRING = " . $result_string;
    send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4");

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}

	else if ($result_string == 'Not a new user')


		{


			$confirmation = '<span class="error">' . __('Our records indicate that you have already requested a trial using this email address. Please contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';


		}


	else if (substr_count($result_string,"Fatal error") >= 1)


		{


				// Display Message that there is a form erro)


				$confirmation = '<span class="error">' . __('We apologize for the inconvenience but we are currently having technical issues with our download forms. If you would like to request a trial of SpinFire please contact us at ', 'actify') . ' <a href="mailto:sales@actify.com?subject=Spinfire Trial Request From Failed Form Submission">sales@actify.com</a></span>';


		}

	else
	{

		// Send the license email
		
		$message =  "SENDING EMAIL = ";
        	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4 - sending email");

		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
	
//for testing only
//$email="richm@revenuesystems.biz";
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
		list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id, $lead);

		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		//send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		//send_email($lead['2'], $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		send_email('no-reply@actify.com', $subject, $body, 'Actify', 'no-reply@actify.com');
/*
 		// Send the license email

                        $seat_license_xml = new SimpleXMLElement($result_string);

                        $lead_id = (string)$seat_license_xml->lead_id;
                        $seat_id = (string)$seat_license_xml->seat_id;

                        $email_language = actify_get_email_language_code($lead['1']);

                        require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
                        list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id);
			$message = "SENDING EMAIL - LEAD = " . $lead_id . ", TO = " . $lead['2'] .  ", SUBJECT =a" .  $subject . ", BODY = " . $body;
			send_to_log($message, "forms.php - form 22 - Send the license email");
                        actify_send_license_email($lead_id, $lead['2'], $subject, $body);
                        // Redirect to SpinFire Professional Trial Thank You page
                        //$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));

		// Redirect to SpinFire Ultimate Trial Thank You page
		//$confirmation = array('redirect' => get_permalink( icl_object_id($thank_you_page_id, 'page', true) ));
		//$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));
*/
	}
	
		$message =  "DISPLAYING CONFIRMATION  ";
        	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4 - AFTER sending email");
	return $confirmation;
}

// AT RBM SUGGESTIONS Charisse decided not to Delete leads after SpinFire Ultimate Trial form is submitted
//This is just a Gravity forms table that saves a record of every form submission. 
//This is a good log of all submissions that may be hepful in case of an unseen issue. 
//It has no role and causes no harm to keep the records in this file.
//This is different thn the file "actify_unsubmitted_leads" which is used when a lead cannot be submitted to alesforce.
//add_action('gform_after_submission_21', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Trial form
add_action('gform_after_submission_21', 'actify_save_form_field_values_21', 10, 2);
function actify_save_form_field_values_21($lead, $form)
{
	$message =  "SAVING FORM FIELDS  ";
        send_to_log($message, "forms.php - actify_save_form_field_values_21 ");

	$field_values = array();
	
	$field_values['salutation'] = $lead['2'];
	$field_values['first_name'] = $lead['3.3'];
	$field_values['last_name'] = $lead['3.6'];
	$field_values['company'] = $lead['4'];
	$field_values['phone'] = $lead['5'];
	$field_values['email'] = $lead['6'];
	$field_values['street1'] = $lead['7.1'];
	$field_values['street2'] = $lead['7.2'];
	$field_values['city'] = $lead['7.3'];
	$field_values['state'] = $lead['7.4'];
	$field_values['zip_code'] = $lead['7.5'];
	$field_values['country'] = $lead['7.6'];
	
	actify_save_form_field_values($field_values);
}
//END of FORM _21

//FORM _22 Starts Here
// Submits DATA DISCOVERY form data to Salesforce
add_action('gform_after_submission_22', 'actify_process_data_discovery_and_actify_insight_form', 10, 2);
// Delete leads after SpinFire Ultimate Trial form is submitted
//add_action('gform_after_submission_22', 'actify_remove_gravity_form_entry_callback', 10, 2);
// Save field values for the DATA DISCOVERY form
add_action('gform_after_submission_22', 'actify_save_form_field_values_data_discovery_and_actify_insight_form', 10, 2);
 //END OF _22

//FORM _23 Starts Here Handled same as _22 and uses same functions
// Submits DATA DISCOVERY form data to Salesforce
add_action('gform_after_submission_23', 'actify_process_data_discovery_and_actify_insight_form', 10, 2);
// Delete leads after SpinFire Ultimate Trial form is submitted
//add_action('gform_after_submission_23', 'actify_remove_gravity_form_entry_callback', 10, 2);
// Save field values for the DATA DISCOVERY form
add_action('gform_after_submission_23', 'actify_save_form_field_values_data_discovery_and_actify_insight_form', 10, 2);
 //END OF _23
function actify_process_data_discovery_and_actify_insight_form($lead, $form)
{
	// Build the Salesforce lead
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Title'] = $lead['12'];
	$salesforce_lead['Email'] = $lead['2'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Company_Size__c'] = $lead['13'];
	$salesforce_lead['City'] = $lead['11.3'];
	$salesforce_lead['Country'] = $lead['11.6'];
	$salesforce_lead['Phone'] = $lead['5'];
	$salesforce_lead['Comments__c'] = $lead['10'];
	$salesforce_lead['Product_Interest__c'] = $lead['15'];
	
	var_log($lead, "LEAD", "forms.php - actify_process_data_discovery_and_actify_insight_form");
	var_log($salesforce_lead, "SALESFORCE_LEAD", "forms.php - actify_process_data_discovery_and_actify_insight_form");
	$message = "SALESFORCE_LEAD <b>CampaignId</b>: " . $lead['14'];
	send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
	
	// Submit to Salesforce
	$salesforce_ok=actify_submit_lead_to_salesforce($salesforce_lead, array('CampaignId' => $lead['14']));
	$message = "      RESULT OF SUBMITTED TO SALESFOCE =" . $salesforce_ok;
	send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
	
	$message = "LEAD VALUES AFTER RETURN FROM SUBMIT-TO-SALESFORCE AFTER SUCCESS SUBMISSION TO SALESFORCE";
	send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
	var_log($lead, "LEAD", "forms.php - actify_process_data_discovery_and_actify_insight_form");
	
	$email_language = actify_get_email_language_code($lead['1']);
	require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/get_sfp_trial_email_subject_and_body.php');
	list($subject, $body) = get_sfp_trial_email_subject_and_body($seat_id);
	actify_send_license_email($lead_id, $lead['6'], $subject, $body);

	//check_to_delete_wp_form_record($lead, $salesforce_ok);
	//Always delete the WP form record
	$message = "DELETING LEAD FROM WORDPRRESS FORM RECORD. ALWAYS DO THIS EVEN IF FAILED SUBMISSION TO SALESFORCE. ";
    	send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
		actify_remove_gravity_form_entry($lead);
		
}

function check_to_delete_wp_form_record($lead, $salesforce_ok) {
	//remove the lead from wordpress if submitted to salesforce successfully. This is standard process for all forms at actify.
	if ($salesforce_ok === 0) {
		$message = "NOT DELETING LEAD FROM WORDPRRESS BECAUSE VAR SALESFORCE_OK = 0. VAR SALESFORCE_OK ACTUALLY = $salesforce_ok";
		send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
	}
	else {
		$message = "DELETING LEAD FROM WORDPRRESS BECAUSE VAR SALESFORCE_OK != 0. VAR SALESFORCE_OK ACTUALLY = $salesforce_ok ";
    	send_to_log($message, "forms.php - actify_process_data_discovery_and_actify_insight_form");
		actify_remove_gravity_form_entry($lead);
	}
	 
}

function actify_save_form_field_values_data_discovery_and_actify_insight_form($lead, $form)
{
	$field_values = array();
	
	$field_values['first_name'] = $lead['1.3'];
	$field_values['last_name'] = $lead['1.6'];
	$field_values['title'] = $lead['12'];
	$field_values['email'] = $lead['2'];
	$field_values['company'] = $lead['3'];
	$field_values['city'] = $lead['11.3'];
	$field_values['country'] = $lead['11.6'];
	$field_values['phone'] = $lead['5'];
	
	actify_save_form_field_values($field_values);
}



/**** SpinFire Ultimate Trial - NEW ****/
// FORM _25 STARTS HERE
// Handle the SpinFire Ultimate Trial form license request and confirmation message

add_filter('gform_confirmation_25', 'actify_process_spinfire_ultimate_trial_form_25', 10, 4);
function actify_process_spinfire_ultimate_trial_form_25($confirmation, $form, $lead, $ajax)
{
	$thank_you_page_id = 11441;
	$error_confirmation_message = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	
	// Do a trial license request
	// Build the Salesforce lead

/*
	$salesforce_lead = array();
	$salesforce_lead['FirstName'] = $lead['1.3'];
	$salesforce_lead['LastName'] = $lead['1.6'];
	$salesforce_lead['Title'] = "";
	$salesforce_lead['Email'] = $lead['2'];
	$salesforce_lead['Company'] = $lead['3'];
	$salesforce_lead['Company_Size__c'] = "";
	$salesforce_lead['City'] = $lead['11.3'];
	$salesforce_lead['Country'] = $lead['11.6'];
	$salesforce_lead['Phone'] = $lead['5'];
	$salesforce_lead['Comments__c'] = $lead['10'];
	$salesforce_lead['Product_Interest__c'] = "'SpinFire Ultimate Trial'";
*/	
	var_log($lead, "LEAD", "forms.php - actify_process_spinfire_ultimate_trial_form_25");
	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form_25");
	$license_request_url = actify_get_trial_license_request_url(
$lead['9'],  //Language
$lead['12'],  //Salutation
$lead['1.3'],  //FirstName 
$lead['1.6'],  //LastName
$lead['3'],  //Company
$lead['5'],  //Phone
$lead['2'],   //Email
$lead['13.1'], //Street
$lead['13.2'], //Street
$lead['11.3'],  //City
$lead['13.4'], //State
$lead['13.5'], //Zip
$lead['11.6'],  //Country
$lead['10'], //Comments
$lead['14'], //campaign_id
$lead['15'], //Product_Interest__c
$lead['16'], //Version
$lead['17'], //Company Size
$lead['18'],   //Title
$lead['6'], //EOM Date,
$lead['4']); //License Type
	
	$message =  "LICENSE REQUEST URL = " .$license_request_url;
	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4");

	$result_string = file_get_contents($license_request_url);

	$message = "SPINFIRE ULTIMATE RESULT STRING = " . $result_string;
    	send_to_log($message, "forms.php - actify_process_spinfire_ultimate_trial_form4");

	if ($result_string == 'Problem with license server')
	{
		$confirmation = '<span class="error">' . __('An error has occurred generating your license. Please try again later, or contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';
	}

	else if ($result_string == 'Not a new user')


		{


			$confirmation = '<span class="error">' . __('Our records indicate that you have already requested a trial using this email address. Please contact', 'actify') . ' <a href="mailto:sales@actify.com">sales@actify.com</a>' . '</span>';


		}


	else if (substr_count($result_string,"Fatal error") >= 1)


		{


				// Display Message that there is a form erro)


				$confirmation = '<span class="error">' . __('We apologize for the inconvenience but we are currently having technical issues with our download forms. If you would like to request a trial of SpinFire please contact us at ', 'actify') . ' <a href="mailto:sales@actify.com?subject=Spinfire Trial Request From Failed Form Submission">sales@actify.com</a></span>';


		}

	else
	{

		// Send the license email
		
		$seat_license_xml = new SimpleXMLElement($result_string);

		$lead_id = (string)$seat_license_xml->lead_id;
		$seat_id = (string)$seat_license_xml->seat_id;
		
		// Get the email to send to
		require_once($_SERVER['DOCUMENT_ROOT'] . '/salesforce/actify_specific/get_lead_owner_and_regional_sales_manager_and_email.php');
		list(, , $email) = get_lead_owner_and_regional_sales_manager_and_email($lead['6']);
		
		$email_language = actify_get_email_language_code($lead['9']);
	
//for testing only
//$email="richm@revenuesystems.biz";
		require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
		list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id, $lead);

		require_once(get_stylesheet_directory() . '/emails/send_email.php');
		//send_email($email, $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		//send_email($lead['2'], $subject, $body, 'Actify', 'no-reply@actify.com', array('cdalton@actify.com'));
		send_email($lead['2'], $subject, $body, 'Actify', 'no-reply@actify.com');
/*
 		// Send the license email

                        $seat_license_xml = new SimpleXMLElement($result_string);

                        $lead_id = (string)$seat_license_xml->lead_id;
                        $seat_id = (string)$seat_license_xml->seat_id;

                        $email_language = actify_get_email_language_code($lead['1']);

                        require_once(get_stylesheet_directory() . '/emails/' . $email_language . '/sf11/get_sfu_trial_email_subject_and_body.php');
                        list($subject, $body) = get_sfu_trial_email_subject_and_body($seat_id);
			$message = "SENDING EMAIL - LEAD = " . $lead_id . ", TO = " . $lead['2'] .  ", SUBJECT =a" .  $subject . ", BODY = " . $body;
			send_to_log($message, "forms.php - form 22 - Send the license email");
                        actify_send_license_email($lead_id, $lead['2'], $subject, $body);
                        // Redirect to SpinFire Professional Trial Thank You page
                        //$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));

		// Redirect to SpinFire Ultimate Trial Thank You page
		//$confirmation = array('redirect' => get_permalink( icl_object_id($thank_you_page_id, 'page', true) ));
		//$confirmation = array('redirect' => get_permalink( icl_object_id(669, 'page', true) ));
*/
	}
	
	return $confirmation;
}

// Delete leads after SpinFire Ultimate Trial form is submitted
add_action('gform_after_submission_25', 'actify_remove_gravity_form_entry_callback', 10, 2);

// Save field values for the SpinFire Ultimate Trial form
add_action('gform_after_submission_25', 'actify_save_form_field_values_25', 10, 2);
function actify_save_form_field_values_25($lead, $form)
{
	$field_values = array();
	
	$field_values['salutation'] = $lead['2'];
	$field_values['first_name'] = $lead['3.3'];
	$field_values['last_name'] = $lead['3.6'];
	$field_values['company'] = $lead['4'];
	$field_values['phone'] = $lead['5'];
	$field_values['email'] = $lead['6'];
	$field_values['street1'] = $lead['7.1'];
	$field_values['street2'] = $lead['7.2'];
	$field_values['city'] = $lead['7.3'];
	$field_values['state'] = $lead['7.4'];
	$field_values['zip_code'] = $lead['7.5'];
	$field_values['country'] = $lead['7.6'];
	
	actify_save_form_field_values($field_values);
}
//END of FORM _25
?>
