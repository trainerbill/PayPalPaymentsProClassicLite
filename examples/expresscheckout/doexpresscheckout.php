<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require(__DIR__.'/../../src/ExpressCheckout/GetExpressCheckout.php');
require(__DIR__.'/../../src/ExpressCheckout/DoExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\DoExpressCheckout;
use PayPalPaymentsProClassicLite\ExpressCheckout\GetExpressCheckout;

if(!isset($_GET['token']))
	die('You need to provide a token.');

//Use GetEC to get some information back
$getec = new GetExpressCheckout();
$variables = array(
		'TOKEN' => $_GET['token'],			//GET token
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get the response decoded into an array
$getresponse = $getec->getCallResponseDecoded();

//Create Do Express Checkout class
$doec = new DoExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
$variables = array(
	'TOKEN' => $getresponse['TOKEN'],			//GET token
	'PAYERID' => $getresponse['PAYERID'],		//GET Payerid
	'PAYMENTREQUEST_0_AMT' => $getresponse['AMT'],
);

if(isset($getresponse['PAYMENTREQUEST_0_CUSTOM']) && $getresponse['PAYMENTREQUEST_0_CUSTOM'] == 'OAC')
	$variables['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Order';
	
//Place the variables onto the stack
$doec->pushVariables($variables);

//Execute the Call via CURL
$doec->executeCall();

//Get Submit String
$sstring = $doec->getCallQuery();

//Submitted Variables
$svars = $doec->getCallVariables();

//Get the response decoded into an array
$rvars = $doec->getCallResponseDecoded();

//Get the raw response
$rstring = $doec->getCallResponse();

//Get Endpoint
$endpoint = $doec->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>

<?php if($rvars['ACK'] == 'Failure' && ( $rvars['L_ERRORCODE0'] == '10486' || $rvars['L_ERRORCODE0'] == '10422') ) :?>
		<a class="btn btn-default" href="https://www.sandbox.paypal.com/checkoutnow?token=<?php echo $getresponse['TOKEN'] ?>">Choose New Funding Source</a>
<?php endif;?>

<?php if(isset($getresponse['CUSTOM'])) :?>

	<?php if($getresponse['CUSTOM'] == 'BillingAgreement'):?>
	<a class="btn btn-default" href="billingagreements/updatebillingagreement.php?baid=<?php echo $rvars['BILLINGAGREEMENTID']?>">Update Billing Agreement</a>
	<a class="btn btn-default" href="../referencetransactions/rt.php?baid=<?php echo $rvars['BILLINGAGREEMENTID']?>">Do Reference Transaction</a>
	<?php endif;?>

	<?php if($getresponse['CUSTOM'] == 'RecurringPayment'):?>
	<a class="btn btn-default" href="recurringpayments/createrecurringpaymentsprofile.php?token=<?php echo $rvars['TOKEN'] ?>">Create Recurring Payment Profile</a>
	<?php endif;?>
	
	<?php if($getresponse['CUSTOM'] == 'OAC'):?>
	<a class="btn btn-default" href="oac/doauthorization.php?trxid=<?php echo $rvars['PAYMENTINFO_0_TRANSACTIONID'] ?>">Do Authorization</a>
	<?php endif;?>
	
<?php endif;?>
<?php include(__DIR__.'/../inc/footer.php');?>