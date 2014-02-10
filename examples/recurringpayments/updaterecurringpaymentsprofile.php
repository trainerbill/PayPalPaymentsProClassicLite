<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require(__DIR__.'/../../src/RecurringPayment/UpdateRecurringPaymentProfile.php');
use PayPalPaymentsProClassicLite\RecurringPayment\CreateRecurringPaymentProfile;


if(!isset($_GET['profileid']))
	die('You have to have a profile id');

//Create Get Express Checkout class
$rp = new UpdateRecurringPaymentProfile();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/UpdateRecurringPaymentsProfile_API_Operation_NVP/
$variables = array(
	'PROFILEID' => $_GET['profileid'],									//GET Profile ID
	'BILLINGPERIOD'	=> 'Week',											//Set Billing Period
	'BILLINGFREQUENCY' => 52,											//Set Billing Frequency
	'AMT'	=> '50.00',													//From GetEC
);

//Place the variables onto the stack
$rp->pushVariables($variables);

//Execute the Call via CURL
$rp->executeCall();

//Get Submit String
$sstring = $rp->getCallQuery();

//Submitted Variables
$svars = $rp->getCallVariables();

//Get the response decoded into an array
$rvars = $rp->getCallResponseDecoded();

//Get the raw response
$rstring = $rp->getCallResponse();

//Get Endpoint
$endpoint = $rp->getCallEndpoint();

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>
<a class="btn btn-default" href="getrecurringpaymentprofiledetails.php?profileid=<?php echo $rvars['PROFILEID']?>">Get Recurring Payment Profile Details</a>

<?php include(__DIR__.'/../inc/footer.php');?>