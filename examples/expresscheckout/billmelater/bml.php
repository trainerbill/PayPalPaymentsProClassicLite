<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillMeLater;
require(__DIR__.'/../../../src/ExpressCheckout/BillMeLater/SetExpressCheckoutBML.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\BillMeLater\SetExpressCheckoutBML;

//Create Set Express Checkout class
$setec = new SetExpressCheckoutBML();


//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'http://localhost/PayPalPaymentsProClassicLite/examples/getexpresscheckout.php',	
	'CANCELURL' => 'http://localhost/PayPalPaymentsProClassicLite/examples/cancel.php',
	'PAYMENTREQUEST_0_AMT' => '100.00',
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order
);

//Place the variables onto the stack
$setec->pushVariables($variables);

//Execute the Call via CURL
$setec->executeCall();

//Get Submit String
$sstring = $setec->getCallQuery();

//Submitted Variables
$svars = $setec->getCallVariables();

//Get the response decoded into an array
$rvars = $setec->getCallResponseDecoded();

//Get the raw response
$rstring = $setec->getCallResponse();

//Get Endpoint
$endpoint = $setec->getCallEndpoint();

include(__DIR__.'/../../inc/header.php');
include(__DIR__.'/../../inc/apicalloutput.php');
?>

<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token=<?php echo $rvars['TOKEN'] ?>"><img src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_bml_SM.png" alt="BML" /></a>

<?php 
/*
 * Normally you would want to do a header redirect after the set ec but for the example I want to show
 * the submit and response returns.
 * //Redirect to PayPal or return back to referer with error.
if($response['ACK'] != 'Success')
	header('Location: '.$_SERVER['HTTP_REFERER'] . '?error='.$response['L_ERRORCODE0'].'&short='.$response['L_SHORTMESSAGE0'].'&long='.$response['L_LONGMESSAGE0']);
else
	header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token='.$response['TOKEN']);
 * 
 */

include(__DIR__.'/../../inc/footer.php');