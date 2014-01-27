<?php
//namespace PayPalPaymentsProClassicLite\ExpressCheckout\Callback;
//require(__DIR__.'/../../src/ExpressCheckout/CallbackResponse.php');
//require(__DIR__.'/../../src/ExpressCheckout/GetExpressCheckout.php');
//use PayPalPaymentsProClassicLite\ExpressCheckout\CallbackResponse;
//use PayPalPaymentsProClassicLite\ExpressCheckout\GetExpressCheckout;
echo 'yes';
print_r($_POST);exit;

if(!isset($_GET['token']))
	die('You need to provide a token.');

//Use GetEC to get variables
$getec = new GetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'TOKEN' => $_GET['token'],
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get the response decoded into an array
$response = $getec->getCallResponseDecoded();


//Create Callback
$cb = new Callback();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'TOKEN' => $_GET['token'],	
	'L_PAYMENTREQUEST_0_NAME0'	=>	'Test item',
	'L_PAYMENTREQUEST_0_DESC0'	=>	'This is a very cool test item.',
	'L_PAYMENTREQUEST_0_AMT0'	=>	'100.00',
	'L_PAYMENTREQUEST_0_QTY0'	=>	'1',
);

//Place the variables onto the stack
$cb->pushVariables($variables);

//Execute the Call via CURL
$cb->executeCall();

//Get Submit String
$sstring = $cb->getCallQuery();

//Submitted Variables
$svars = $cb->getCallVariables();

//Get the response decoded into an array
$rvars = $cb->getCallResponseDecoded();

//Get the raw response
$rstring = $cb->getCallResponse();

//Get Endpoint
$endpoint = $cb->getCallEndpoint();

include('../inc/apicalloutput.php');
?>


<?php if($cb->expresscheckout_settings['experience'] == 'redirect'):?>
<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=<?php echo $cb->expresscheckout_settings['useraction'] ?>&token=<?php echo $rvars['TOKEN'] ?>">Redirect to PayPal</a>
<?php elseif($cb->expresscheckout_settings['experience'] == 'lightbox'): ?>
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