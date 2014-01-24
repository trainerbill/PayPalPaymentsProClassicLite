<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement;
require(__DIR__.'/../../../src/ExpressCheckout/BillingAgreement/UpdateBillingAgreement.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement\UpdateBillingAgreement;

//Create Set Express Checkout class
$uba = new UpdateBillingAgreement();

if(!isset($_GET['baid']))
	die('Billing Agreement ID not set.');

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'REFERENCEID' => $_GET['baid'],
	'BILLINGAGREEMENTSTATUS' => 'Canceled',		//Cancel BA
);

//Place the variables onto the stack
$uba->pushVariables($variables);

//Execute the Call via CURL
$uba->executeCall();

//Get Submit String
$sstring = $uba->getCallQuery();

//Submitted Variables
$svars = $uba->getCallVariables();

//Get the response decoded into an array
$rvars = $uba->getCallResponseDecoded();

//Get the raw response
$rstring = $uba->getCallResponse();

//Get Endpoint
$endpoint = $uba->getCallEndpoint();

include('../../inc/apicalloutput.php');
?>

<a href="../../index.php">Back to Home</a><br/>