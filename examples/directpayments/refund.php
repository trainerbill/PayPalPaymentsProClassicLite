<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/RefundTransaction.php');
use PayPalPaymentsProClassicLite\DirectPayment\RefundTransaction;

if(!isset($_GET['trxid']))
	die('You have to have a transaction id.');

//Create Get Express Checkout class
$dcc = new RefundTransaction();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/RefundTransaction_API_Operation_NVP/
$variables = array(
	'TRANSACTIONID' => $_GET['trxid'],
	'REFUNDTYPE' => 'Full',
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

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>
<a class="btn btn-default" href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['REFUNDTRANSACTIONID'] ?>">Get Transaction Details</a>

<?php include(__DIR__.'/../inc/footer.php');?>