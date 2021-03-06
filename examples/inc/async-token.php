<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require(__DIR__.'/../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;

//Create Set Express Checkout class
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'https://'.$_SERVER['HTTP_HOST'].preg_replace('/inc\/async-token.php/','expresscheckout/getexpresscheckout.php',$_SERVER['SCRIPT_NAME']),	
	'CANCELURL' => 'https://'.$_SERVER['HTTP_HOST'].preg_replace('/inc\/async-token.php/','expresscheckout/getexpresscheckout.php',$_SERVER['SCRIPT_NAME']),
	'PAYMENTREQUEST_0_AMT' => '100.00',
	'PAYMENTREQUEST_0_ITEMAMT' => '100.00',
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order,	
);

if (isset($_GET['version'])) {
	
	$variables['VERSION'] = $_GET['version'];
	if ($variables['VERSION'] < 62 ) {
		$variables['AMT'] = '100.00';
	}
}



//Place the variables onto the stack
$setec->pushVariables($variables);

//Execute the Call via CURL
$setec->executeCall();

//Get Submit String
$sstring = $setec->getCallQuery();

//Submitted Variables
$svars = $setec->getCallVariables();

//Get the response decoded into an array
$rvars = $setec->getCallResponseDecoded();

//Get the raw response
$rstring = $setec->getCallResponse();

//Get Endpoint
$endpoint = $setec->getCallEndpoint();

echo json_encode(array('token' => $rvars['TOKEN']));