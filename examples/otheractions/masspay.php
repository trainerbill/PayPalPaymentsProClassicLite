<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require(__DIR__.'/../../src/OtherActions/MassPay.php');
use PayPalPaymentsProClassicLite\OtherActions\MassPay;


//Create Get Express Checkout class
$av = new MassPay();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/MassPay_API_Operation_NVP/
$variables = array(
	'CURRENCYCODE' => 'USD',
	'RECEIVERTYPE' =>	'EmailAddress',
	'L_EMAIL0'	=> 'buyer@awesome.com',
	'L_AMT0'	=> '100.25',
	'L_EMAIL1'	=> 'buyer1@awesome.com',
	'L_AMT1'	=> '75.24',
	'L_EMAIL2'	=> 'seller1@awesome.com',
	'L_AMT2'	=> '50.87',
);

//Place the variables onto the stack
$av->pushVariables($variables);

//Execute the Call via CURL
$av->executeCall();

//Get Submit String
$sstring = $av->getCallQuery();

//Submitted Variables
$svars = $av->getCallVariables();

//Get the response decoded into an array
$rvars = $av->getCallResponseDecoded();

//Get the raw response
$rstring = $av->getCallResponse();

//Get Endpoint
$endpoint = $av->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>
<?php include(__DIR__.'/../inc/footer.php');?>