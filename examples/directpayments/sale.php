<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/DoDirectPayment.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoDirectPayment;


//Create Get Express Checkout class
$dcc = new DoDirectPayment();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoDirectPayment_API_Operation_NVP/
$variables = array(
	'PAYMENTACTION' => 'Sale',
	'AMT' => '100.00',
	'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
	'ACCT' =>	'4929477536696164',				//From getcreditcardnumbers.com
	'EXPDATE'	=> '092016',					//Any future data: MMYYYY
	'CVV2'		=> '111',						//Any 3 digit number
	'FIRSTNAME' => 'Fred',
	'LASTNAME'	=> 'Flintstone',
	'STREET'	=> '123 Bedrock Street',
	'CITY'		=> 'Bedrock',
	'STATE'		=> 'CA',
	'COUNTRYCODE' => 'US', 
	'ZIP'		=> '90210',
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

<?php if($rvars['ACK'] == 'Success'):?>
<a class="btn btn-default" href="refund.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Refund Transaction</a>
<a class="btn btn-default" href="../referencetransactions/rt.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Do Reference Transaction</a>
<a class="btn btn-default" href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['TRANSACTIONID'] ?>">Get Transaction Details</a>
<?php endif;?>

<?php include(__DIR__.'/../inc/footer.php');?>