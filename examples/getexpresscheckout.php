<?php
namespace GetEC;
require('../GetExpressCheckout.php');
use PayPalExpressCheckoutLite\GetExpressCheckout;

//Create Get Express Checkout class
$getec = new GetExpressCheckout();

//Set sandbox mode
$getec->setSandboxMode();

//Get You api credentials https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/merchant/wppro/WPProIntegrationSteps-outside
$credentials = array(
		'USER'	=>	'',         //Your User
		'PWD'	=>	'',         //Your Password
		'SIGNATURE'	=> '',      //Your signature
);
$getec->setCredentials($credentials);

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
		'TOKEN' => '',
		'VERSION' => '109.0'
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get the response decoded into an array
$response = $getec->getCallResponseDecoded();

//Get the raw response
$string = $getec->getCallResponse();