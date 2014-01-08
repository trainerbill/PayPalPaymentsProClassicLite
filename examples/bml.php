<?php
namespace SetEC;
require('../src/SetExpressCheckoutBML.php');
use PayPalExpressCheckoutLite\SetExpressCheckoutBML;

//Create Set Express Checkout class
$setec = new SetExpressCheckoutBML();


//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'http://localhost/PayPalExpressCheckoutLite/examples/getexpresscheckout.php',	
	'CANCELURL' => 'http://localhost/PayPalExpressCheckoutLite/examples/cancel.php',
	'PAYMENTREQUEST_0_AMT' => '100.00',
	'CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order
	'VERSION' => '109.0',

	//Set userid as custome field
	'PAYMENTREQUEST_0_CUSTOM' => '',
		
	//Line Items
	'L_PAYMENTREQUEST_0_NAME0' => '',
	'L_PAYMENTREQUEST_0_DESC0' => '',
	'L_PAYMENTREQUEST_0_AMT0' => '',
);

//Place the variables onto the stack
$setec->pushVariables($variables);

//Execute the Call via CURL
$setec->executeCall();

//Get the response decoded into an array
$response = $setec->getCallResponseDecoded();

//Get the raw response
$string = $setec->getCallResponse();
?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $setec->getCallEndpoint() ?> -d "<?php echo $setec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $setec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $setec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>

<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=confirm&token=<?php echo $response['TOKEN'] ?>">Redirect to PayPal</a>

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

