<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/DoNonReferencedCredit.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoNonReferencedCredit;


//Create Get Express Checkout class
$dcc = new DoNonReferencedCredit();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoNonReferencedCredit_API_Operation_NVP/
$variables = array(
	
	'AMT' => '100.00',
	'ACCT' =>	'4929477536696164',				//From getcreditcardnumbers.com	
	'FIRSTNAME' => 'Fred',
	'LASTNAME'	=> 'Flintstone',
	'STREET'	=> '123 Bedrock Street',
	'CITY'		=> 'Bedrock',
	'STATE'		=> 'CA',
	'COUNTRYCODE' => 'US', 
	'ZIP'		=> '90210',
	'CURRENCYCODE' => 'USD',
	'EXPDATE'	=> '082016'	,					//MMYYYY
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get Submit String
$sstring = $dcc->getCallQuery();

//Submitted Variables
$svars = $dcc->getCallVariables();

//Get the response decoded into an array
$rvars = $dcc->getCallResponseDecoded();

//Get the raw response
$rstring = $dcc->getCallResponse();

//Get Endpoint
$endpoint = $dcc->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>