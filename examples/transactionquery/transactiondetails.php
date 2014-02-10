<?php
namespace PayPalPaymentsProClassicLite\TransactionQuery;
require(__DIR__.'/../../src/TransactionQuery/GetTransactionDetails.php');
use PayPalPaymentsProClassicLite\TransactionQuery\GetTransactionDetails;

if(isset($_GET['trxid']))
	$trxid = $_GET['trxid'];
else
	$trxid = '18G39114D1804362B';

//Create Get Express Checkout class
$td = new GetTransactionDetails();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/GetTransactionDetails_API_Operation_NVP/
$variables = array(
	'TRANSACTIONID' => $trxid,					
);

//Place the variables onto the stack
$td->pushVariables($variables);

//Execute the Call via CURL
$td->executeCall();

//Get Submit String
$sstring = $td->getCallQuery();

//Submitted Variables
$svars = $td->getCallVariables();

//Get the response decoded into an array
$rvars = $td->getCallResponseDecoded();

//Get the raw response
$rstring = $td->getCallResponse();

//Get Endpoint
$endpoint = $td->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>

<?php include(__DIR__.'/../inc/footer.php');?>