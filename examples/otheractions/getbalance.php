<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require(__DIR__.'/../../src/OtherActions/GetBalance.php');
use PayPalPaymentsProClassicLite\OtherActions\GetBalance;


//Create Get Express Checkout class
$gb = new GetBalance();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/GetBalance_API_Operation_NVP/
$variables = array(
	'RETURNALLCURRENCIES' => '1',
);

//Place the variables onto the stack
$gb->pushVariables($variables);

//Execute the Call via CURL
$gb->executeCall();

//Get Submit String
$sstring = $gb->getCallQuery();

//Submitted Variables
$svars = $gb->getCallVariables();

//Get the response decoded into an array
$rvars = $gb->getCallResponseDecoded();

//Get the raw response
$rstring = $gb->getCallResponse();

//Get Endpoint
$endpoint = $gb->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>