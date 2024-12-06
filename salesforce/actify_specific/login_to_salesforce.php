<?php


function login_to_salesforce()
{
	require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'SforceEnterpriseClient.php');


	// Must be done because of a php bug
	ini_set('soap.wsdl_cache_enabled', 0);


	// instantiate a new Salesforce Enterprise object
	$crmHandle = new SforceEnterpriseClient();


	// instantiate a SOAP connection to Salesforce
	try
	{
	  $crmHandle->createConnection($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'salesforce' . DIRECTORY_SEPARATOR . 'wsdl' . DIRECTORY_SEPARATOR . 'production' . DIRECTORY_SEPARATOR . 'enterprise.wsdl.xml');
	}
	catch (Exception $e)
	{
		return FALSE;
	}


	// log in to Salesforce
	try
	{
	  $crmHandle->login('sfuk@actify.com', 'florence1' . 'WKkRSrrgQCN6BVdwhpH4ao61r');
	}
	catch (Exception $e)
	{
		return FALSE;
	}


	return $crmHandle;
}


?>