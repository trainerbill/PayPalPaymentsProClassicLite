<?php
namespace DoEC;
require('../DoExpressCheckout.php');
use PayPalExpressCheckoutLite\DoExpressCheckout;

//Create Set Express Checkout class
$doec = new DoExpressCheckout();

//Set sandbox mode
$doec->setSandboxMode();

//Get You api credentials https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/merchant/wppro/WPProIntegrationSteps-outside 
$credentials = array(
		'USER'	=>	'',         //Your User
		'PWD'	=>	'',         //Your Password
		'SIGNATURE'	=> '',      //Your signature
);
$doec->setCredentials($credentials);

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
$variables = array(
	'TOKEN' => '',	
	'PAYERID' => '',
	'VERSION' => '109.0',
	'PAYMENTREQUEST_0_AMT' => '',
);

//Place the variables onto the stack
$doec->pushVariables($variables);

//Execute the Call via CURL
$doec->executeCall();

//Get the response decoded into an array
$response = $doec->getCallResponseDecoded();

//Get the raw response
$string = $doec->getCallResponse();