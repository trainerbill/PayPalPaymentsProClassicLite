<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require(__DIR__.'/../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;

//Create Set Express Checkout class
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'https://'.$_SERVER['HTTP_HOST'].preg_replace('/setexpresscheckout-guest.php/','getexpresscheckout.php',$_SERVER['SCRIPT_NAME']),	
	'CANCELURL' => 'https://'.$_SERVER['HTTP_HOST'].preg_replace('/setexpresscheckout-guest.php/','cancel.php',$_SERVER['SCRIPT_NAME']),	
	'PAYMENTREQUEST_0_AMT' => '100.00',
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order,
	'SOLUTIONTYPE'	=>	'SOLE',
	'LANDINGPAGE'	=>	'Billing'
	
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

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>


<?php if($setec->expresscheckout_settings['experience'] == 'redirect'):?>
<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=<?php echo $setec->expresscheckout_settings['useraction'] ?>&token=<?php echo $rvars['TOKEN'] ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></a>
<?php elseif($setec->expresscheckout_settings['experience'] == 'minibrowser'): 
	include(__DIR__.'/../inc/mbjs.php');
	include( __DIR__ . '/../inc/mbtokenselect.php');
?>

<a href="https://www.sandbox.paypal.com/checkoutnow?token=<?php echo $rvars['TOKEN']?>" data-paypal-button="true"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></a>
<?php endif;?>
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
include(__DIR__.'/../inc/footer.php');
