<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require(__DIR__.'/../../src/ExpressCheckout/GetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\GetExpressCheckout;

if(!isset($_GET['token']))
	die('You need to provide a token.');

//Create Get Express Checkout class
$getec = new GetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
$variables = array(
		'TOKEN' => $_GET['token'],	//GET token from URL
	
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get Submit String
$sstring = $getec->getCallQuery();

//Submitted Variables
$svars = $getec->getCallVariables();

//Get the response decoded into an array
$rvars = $getec->getCallResponseDecoded();

//Get the raw response
$rstring = $getec->getCallResponse();

//Get Endpoint
$endpoint = $getec->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<?php if($getec->expresscheckout_settings['experience'] == 'minibrowser') {
	include( __DIR__ . '/../inc/mbjs.php');
}?>

<a class="btn btn-default" href="doexpresscheckout.php?token=<?php echo $rvars['TOKEN'] ?>&payerid=<?php echo $rvars['PAYERID']?>">Do Express Checkout</a>

<?php if(isset($rvars['CUSTOM'])) :?>

	<?php if($rvars['CUSTOM'] == 'BillingAgreement'):?>
	<div class="alert alert-warning">
	You can create a billing agreement without actually charging the customer by clicking the link below.  Otherwise Select do express checkout to charge the customer
	and create a billing agreement.
		<div><a class="btn btn-default" href="billingagreements/createbillingagreement.php?token=<?php echo $rvars['TOKEN'] ?>">Create Billing Agreement</a></div>
	</div>
	
	<?php endif;?>

	<?php if($rvars['CUSTOM'] == 'RecurringPayment'):?>
	<div class="alert alert-warning">
		You can choose to create a recurring payments profile now which will not charge the customer until the profile runs.  Otherwise you can do the
		do express checkout call, which will charge the customer immediately, and then setup the recurring payments profile.
		<div><a class="btn btn-default" href="recurringpayments/createrecurringpaymentsprofile.php?token=<?php echo $rvars['TOKEN'] ?>">Create Recurring Payment Profile</a></div>
	</div>
	
	<?php endif;?>
<?php endif;?>

<?php include(__DIR__.'/../inc/footer.php');?>