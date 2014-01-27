<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require(__DIR__.'/../../src/RecurringPayment/GetRecurringPaymentProfileDetails.php');
use PayPalPaymentsProClassicLite\RecurringPayment\GetRecurringPaymentProfileDetails;


if(!isset($_GET['profileid']))
	die('You have to have a profile id');

//Create Get Express Checkout class
$rp = new GetRecurringPaymentProfileDetails();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/GetRecurringPaymentsProfileDetails_API_Operation_NVP/
$variables = array(
	'PROFILEID' => $_GET['profileid'],									//GET Profile ID											//From GetEC
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

<?php if($rvars['STATUS'] != 'Cancelled'):?>
<a href="updaterecurringpaymentsprofile.php?profileid=<?php echo $rvars['PROFILEID']?>">Update Recurring Payments Profile</a><br/>
<a href="managerecurringpaymentsprofilestatus.php?profileid=<?php echo $rvars['PROFILEID']?>">Manage Recurring Payments Profile Status</a><br/>
<a href="billoutstandingamount.php?profileid=<?php echo $rvars['PROFILEID']?>">Bill Outstanding Amount</a><br/>
<?php endif;?>