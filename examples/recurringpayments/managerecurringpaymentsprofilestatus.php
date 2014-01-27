<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require(__DIR__.'/../../src/RecurringPayment/ManageRecurringPaymentProfileStatus.php');
use PayPalPaymentsProClassicLite\RecurringPayment\ManageRecurringPaymentProfileStatus;


if(!isset($_GET['profileid']))
	die('You have to have a profile id');

//Create Get Express Checkout class
$rp = new ManageRecurringPaymentProfileStatus();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/ManageRecurringPaymentsProfileStatus_API_Operation_NVP/
$variables = array(
	'PROFILEID' => $_GET['profileid'],									//GET Profile ID
	'ACTION'	=> 'Cancel',											//Cancel profile.  You can use Cancel,Suspend, or Reactivate
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

include('../inc/apicalloutput.php');
?>

<a href="../index.php">Back to Menu</a><br/>
<a href="getrecurringpaymentprofiledetails.php?profileid=<?php echo $rvars['PROFILEID']?>">Get Recurring Payment Profile Details</a>