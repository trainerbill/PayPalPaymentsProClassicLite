<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\OAC;
require(__DIR__.'/../../../src/ExpressCheckout/OAC/DoAuthorization.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\OAC\DoAuthorization;

if(!isset($_GET['trxid']))
	die('You must set a trxid');

//Create Set Express Checkout class
$doauth = new DoAuthorization();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'AMT' => '100.00',
	'TRANSACTIONID' => $_GET['trxid']
);

//Place the variables onto the stack
$doauth->pushVariables($variables);

//Execute the Call via CURL
$doauth->executeCall();

//Get Submit String
$sstring = $doauth->getCallQuery();

//Submitted Variables
$svars = $doauth->getCallVariables();

//Get the response decoded into an array
$rvars = $doauth->getCallResponseDecoded();

//Get the raw response
$rstring = $doauth->getCallResponse();

//Get Endpoint
$endpoint = $doauth->getCallEndpoint();

include(__DIR__.'/../../inc/header.php');
include(__DIR__.'/../../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>
<?php if($rvars['ACK'] == 'Failure' && ( $rvars['L_ERRORCODE0'] == '10486' || $rvars['L_ERRORCODE0'] == '10422') ) :?>
		<a class="btn btn-default" href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&order_id=<?php echo $_GET['trxid'] ?>">Choose New Funding Source</a>
<?php endif;?>
<?php if($rvars['ACK'] == 'Success'):?>
<a class="btn btn-default" href="../../directpayments/void.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Void Transaction</a>
<a class="btn btn-default"href="../../directpayments/capture.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Capture Transaction</a>
<?php endif; ?>
<?php
include(__DIR__.'/../../inc/footer.php');