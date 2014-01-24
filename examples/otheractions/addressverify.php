<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require(__DIR__.'/../../src/OtherActions/AddressVerify.php');
use PayPalPaymentsProClassicLite\OtherActions\AddressVerify;


//Create Get Express Checkout class
$av = new AddressVerify();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/CreateRecurringPaymentsProfile_API_Operation_NVP/
$variables = array(
	'EMAIL' => 'buyer@awesome.com',
	'STREET' => '1 Main St',
	'ZIP'	=> '95131',
);

//Place the variables onto the stack
$av->pushVariables($variables);

//Execute the Call via CURL
$av->executeCall();

//Get Submit String
$sstring = $av->getCallQuery();

//Submitted Variables
$svars = $av->getCallVariables();

//Get the response decoded into an array
$rvars = $av->getCallResponseDecoded();

//Get the raw response
$rstring = $av->getCallResponse();

//Get Endpoint
$endpoint = $av->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>