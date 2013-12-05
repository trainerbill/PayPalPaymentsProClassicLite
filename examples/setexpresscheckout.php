<?php
namespace SetEC;
require('../SetExpressCheckout.php');
use PayPalExpressCheckout\SetExpressCheckout;

//Create Set Express Checkout class
$setec = new SetExpressCheckout();

//Set sandbox mode
$setec->setSandboxMode();

//Get You api credentials https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/merchant/wppro/WPProIntegrationSteps-outside 
$credentials = array(
		'USER'	=>	'',         //Your User
		'PWD'	=>	'',         //Your Password
		'SIGNATURE'	=> '',      //Your signature
);
$setec->setCredentials($credentials);

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => '',	
	'CANCELURL' => '',
	'PAYMENTREQUEST_0_AMT' => '',
	'CURRENCYCODE' => '',
	'PAYMENTACTION' => '',
	'VERSION' => '109.0',

	//Set userid as custome field
	'PAYMENTREQUEST_0_CUSTOM' => '',
		
	//Line Items
	'L_PAYMENTREQUEST_0_NAME0' => '',
	'L_PAYMENTREQUEST_0_DESC0' => '',
	'L_PAYMENTREQUEST_0_AMT0' => '',
);

//Place the variables onto the stack
$setec->pushVariables($variables);

//Execute the Call via CURL
$setec->executeCall();

//Get the response decoded into an array
$response = $setec->getCallResponseDecoded();

//Get the raw response
$string = $setec->getCallResponse();

//Redirect to PayPal or return back to referer with error.
if($response['ACK'] != 'Success')
	header('Location: '.$_SERVER['HTTP_REFERER'] . '?error='.$response['L_ERRORCODE0'].'&short='.$response['L_SHORTMESSAGE0'].'&long='.$response['L_LONGMESSAGE0']);
else
	header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token='.$response['TOKEN']);