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

include('../inc/apicalloutput.php');
?>

<a href="doexpresscheckout.php?token=<?php echo $rvars['TOKEN'] ?>&payerid=<?php echo $rvars['PAYERID']?>">Do Express Checkout</a><br/>

<?php if(isset($rvars['CUSTOM'])) :?>
<p>
	<?php if($rvars['CUSTOM'] == 'BillingAgreement'):?>
	You can create a billing agreement without actually charging the customer by clicking the link below.  Otherwise Select do express checkout to charge the customer
	and create a billing agreement.</p>
	<a href="billingagreements/createbillingagreement.php?token=<?php echo $rvars['TOKEN'] ?>">Create Billing Agreement</a><br/>
	<?php endif;?>

	<?php if($rvars['CUSTOM'] == 'RecurringPayment'):?>
	<div>
		You can choose to create a recurring payments profile now which will not charge the customer until the profile runs.  Otherwise you can do the
		do express checkout call, which will charge the customer immediately, and then setup the recurring payments profile.
	</div>
	<a href="recurringpayments/createrecurringpaymentsprofile.php?token=<?php echo $rvars['TOKEN'] ?>">Create Recurring Payment Profile</a><br/>
	<?php endif;?>
<?php endif;?>