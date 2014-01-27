<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/DoCapture.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoCapture;

if(!isset($_GET['trxid']))
	die('You have to have a transaction id.');

//Create Get Express Checkout class
$dcc = new DoCapture();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoCapture_API_Operation_NVP/
$variables = array(
	'AUTHORIZATIONID' => $_GET['trxid'],
	'AMT' => '100.00',
	'COMPLETETYPE' => 'Complete',				//Options are Complete or NotComplete
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
<?php if($rvars['ACK'] == 'Success'):?>
<a href="refund.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Refund Transaction</a><br/>
<a href="../referencetransactions/rt.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Do Reference Transaction</a><br/>
<div><a href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['TRANSACTIONID'] ?>">Get Transaction Details</a></div>
<?php endif;?>