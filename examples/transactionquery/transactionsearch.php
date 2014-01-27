<?php
namespace PayPalPaymentsProClassicLite\TransactionQuery;
require(__DIR__.'/../../src/TransactionQuery/TransactionSearch.php');
use PayPalPaymentsProClassicLite\TransactionQuery\TransactionSearch;


//Create Get Express Checkout class
$ts = new TransactionSearch();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/TransactionSearch_API_Operation_NVP/
$variables = array(
	'STARTDATE' => date('Y-m-d\TG:i:s',strtotime('-1week')),		//Set Start date to a week ago
	'ENDDATE' => date('Y-m-d\TG:i:s'),								//Set End Date to now
);

//Place the variables onto the stack
$ts->pushVariables($variables);

//Execute the Call via CURL
$ts->executeCall();

//Get Submit String
$sstring = $ts->getCallQuery();

//Submitted Variables
$svars = $ts->getCallVariables();

//Get the response decoded into an array
$rvars = $ts->getCallResponseDecoded();

//Get the raw response
$rstring = $ts->getCallResponse();

//Get Endpoint
$endpoint = $ts->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>