<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/DoVoid.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoVoid;

if(!isset($_GET['trxid']))
	die('You have to have a transaction id.');

//Create Get Express Checkout class
$dcc = new DoVoid();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoVoid_API_Operation_NVP/
$variables = array(
	'AUTHORIZATIONID' => $_GET['trxid'],
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
<div><a href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['AUTHORIZATIONID'] ?>">Get Transaction Details</a></div>
