<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require(__DIR__.'/../../src/OtherActions/GetPalDetails.php');
use PayPalPaymentsProClassicLite\OtherActions\GetPalDetails;


//Create Get Express Checkout class
$gp = new GetPalDetails();

//Place the variables onto the stack
//$gp->pushVariables($variables);

//Execute the Call via CURL
$gp->executeCall();

//Get Submit String
$sstring = $gp->getCallQuery();

//Submitted Variables
$svars = $gp->getCallVariables();

//Get the response decoded into an array
$rvars = $gp->getCallResponseDecoded();

//Get the raw response
$rstring = $gp->getCallResponse();

//Get Endpoint
$endpoint = $gp->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>