<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\Callback;
require(__DIR__.'/../../../src/ExpressCheckout/Callback/SetExpressCheckoutCallback.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\Callback\SetExpressCheckoutCallback;

//Create Set Express Checkout class
$setec = new SetExpressCheckoutCallback();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalExpressCheckoutLite/examples/expresscheckout/getexpresscheckout.php',	
	'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalExpressCheckoutLite/examples/expresscheckout/cancel.php',
	'PAYMENTREQUEST_0_AMT' => '105.00',
	'PAYMENTREQUEST_0_ITEMAMT'	=> '100.00',
	'PAYMENTREQUEST_0_SHIPPINGAMT' => '5.00',
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order
	
	//Set Callback URL
	'CALLBACK' => 'http://10.248.138.86/PayPalExpressCheckoutLite/examples/expresscheckout/callback/callback.php',
	'MAXAMT'	=> '150.00',
	'CALLBACKTIMEOUT'	=> '6',
	
	//Set Flat rate shipping amount and name.  Required if CALLBACK URL is set
	'L_SHIPPINGOPTIONAMOUNT0' => '5.00',
	'L_SHIPPINGOPTIONNAME0'	  => 'FlatRate',
	'L_SHIPPINGOPTIONISDEFAULT0' => 'true',
	
	//Setup Line item.  1 Line item required for callback
	'L_PAYMENTREQUEST_0_NAME0'	=>	'Test item',
	'L_PAYMENTREQUEST_0_DESC0'	=>	'This is a very cool test item.',
	'L_PAYMENTREQUEST_0_AMT0'	=>	'100.00',
	'L_PAYMENTREQUEST_0_QTY0'	=>	'1',
		
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

include('../../inc/apicalloutput.php');
?>

<?php if($setec->expresscheckout_settings['experience'] == 'redirect'):?>
<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=<?php echo $setec->expresscheckout_settings['useraction'] ?>&token=<?php echo $rvars['TOKEN'] ?>">Redirect to PayPal</a>
<?php elseif($setec->expresscheckout_settings['experience'] == 'lightbox'): ?>
<a href="https://www.sandbox.paypal.com/checkoutnow?token=<?php echo $rvars['TOKEN']?>" data-paypal-button="true">Lightbox</a>
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

