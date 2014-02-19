<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require(__DIR__.'/../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;

//Create Set Express Checkout class
$setec = new SetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'RETURNURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProClassicLite/examples/expresscheckout/getexpresscheckout.php',	
	'CANCELURL' => 'http://'.$_SERVER['HTTP_HOST'].'/PayPalPaymentsProClassicLite/examples/cancel.php',
	'PAYMENTREQUEST_0_AMT' => '100.00',
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',  //Valid values are Sale,Authorization,Order
		
	//Line Items

	//Total Amount of line items
	'PAYMENTREQUEST_0_ITEMAMT' => '100.00',
	
	//ITEM 1	
	'L_PAYMENTREQUEST_0_NAME0'=> 'Test Item 1',
	'L_PAYMENTREQUEST_0_DESC0'=> 'Item 1 description',
	'L_PAYMENTREQUEST_0_AMT0'=> '25.00',
	'L_PAYMENTREQUEST_0_QTY0'=> '2',
		
	//ITEM 2
	'L_PAYMENTREQUEST_0_NAME1'=> 'Test Item 2',
	'L_PAYMENTREQUEST_0_DESC1'=> 'Item 2 description',
	'L_PAYMENTREQUEST_0_AMT1'=> '50.00',
	'L_PAYMENTREQUEST_0_QTY1'=> '1',
	
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
<?php elseif($setec->expresscheckout_settings['experience'] == 'lightbox'): ?>


<script type="text/javascript">
    (function(d, s, id){
      var js, ref = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)){
        js = d.createElement(s); js.id = id; js.async = true;
        js.src = "//www.paypalobjects.com/js/external/paypal.js";
        ref.parentNode.insertBefore(js, ref);
      }
    }(document, "script", "paypal-js"));
</script>


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
