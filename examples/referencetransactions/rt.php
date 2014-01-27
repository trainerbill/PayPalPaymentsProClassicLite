<?php
namespace PayPalPaymentsProClassicLite\ReferenceTransaction;
require(__DIR__.'/../../src/ReferenceTransaction/DoReferenceTransaction.php');
use PayPalPaymentsProClassicLite\ReferenceTransaction\DoReferenceTransaction;

//Create Get Express Checkout class
$rt = new DoReferenceTransaction();

if(isset($_GET['baid']))
	$id = $_GET['baid'];
elseif(isset($_GET['trxid']))
	$id = $_GET['trxid'];
else
	die('You have to have a transaction id or billing agreement id.');

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoReferenceTransaction_API_Operation_NVP/
$variables = array(
	'REFERENCEID' => $id,			//GET Reference ID
	'PAYMENTACTION' => 'Sale',		
	'AMT' => '100.00',
);

//Place the variables onto the stack
$rt->pushVariables($variables);

//Execute the Call via CURL
$rt->executeCall();

//Get Submit String
$sstring = $rt->getCallQuery();

//Submitted Variables
$svars = $rt->getCallVariables();

//Get the response decoded into an array
$rvars = $rt->getCallResponseDecoded();

//Get the raw response
$rstring = $rt->getCallResponse();

//Get Endpoint
$endpoint = $rt->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>
<?php if($rvars['ACK'] == 'Success'):?>
	<?php if($svars['PAYMENTACTION'] == 'Sale'): ?>
		<a href="../directpayments/refund.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Refund Transaction</a><br/>
	<?php endif;?>

<a href="../referencetransactions/rt.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Do Reference Transaction</a><br/>
<?php endif;?>
