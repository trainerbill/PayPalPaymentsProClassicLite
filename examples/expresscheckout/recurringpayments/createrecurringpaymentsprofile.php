<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require(__DIR__.'/../../../src/RecurringPayment/CreateRecurringPaymentProfile.php');
require(__DIR__.'/../../../src/ExpressCheckout/GetExpressCheckout.php');
use PayPalPaymentsProClassicLite\RecurringPayment\CreateRecurringPaymentProfile;
use PayPalPaymentsProClassicLite\ExpressCheckout\GetExpressCheckout;

if(!isset($_GET['token']))
	die('You have to have a token.  Do a Set EC call first');

//Run a GET EC on the token to get some required variables
$getec = new GetExpressCheckout();
$variables = array(
		'TOKEN' => $_GET['token'],
);
$getec->pushVariables($variables);
$getec->executeCall();
$response = $getec->getCallResponseDecoded();

//Create Get Express Checkout class
$rp = new CreateRecurringPaymentProfile();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/CreateRecurringPaymentsProfile_API_Operation_NVP/
$variables = array(
	'TOKEN' => $response['TOKEN'],										//GET Token
	'BILLINGPERIOD'	=> 'Month',											//Set Billing Period
	'BILLINGFREQUENCY' => 1,											//Set Billing Frequency
	'AMT'	=> $response['AMT'],										//From GetEC
	'PROFILESTARTDATE' => date('Y-m-d\TG:i:s',strtotime('+1month')),	//Set the profile to start in one month.
	'DESC'	=>	'test',													//Set description.  IMPORTANT:  This needs to be the same as your in your rp call.
	//'CURRENCYCODE' => $response['CURRENCYCODE'],						//From GetEC
	//'EMAIL'		=>	urldecode($response['EMAIL']),					//From GetEC
	//'PAYERID'	=>	$response['PAYERID'],								//From GetEC
	//'STREET'	=>  $response['SHIPTOSTREET'],   						//From GetEC
	//'CITY'	=>  $response['SHIPTOCITY'],   							//From GetEC
	//'STATE'	=>  $response['SHIPTOSTATE'],   						//From GetEC
	//'COUNTRYCODE'	=>  $response['COUNTRYCODE'],   					//From GetEC
	//'ZIP'	=>  $response['SHIPTOZIP'],   								//From GetEC
	//'MAXFAILEDPAYMENTS' => 3,
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

include(__DIR__.'/../../inc/header.php');
include(__DIR__.'/../../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../../index.php">Back to Menu</a>
<a class="btn btn-default" href="../../recurringpayments/getrecurringpaymentprofiledetails.php?profileid=<?php echo $rvars['PROFILEID']?>">Get Recurring Payment Profile Details</a>
<a class="btn btn-default" href="../../recurringpayments/updaterecurringpaymentsprofile.php?profileid=<?php echo $rvars['PROFILEID']?>">Update Recurring Payments Profile</a>

<?php include(__DIR__.'/../../inc/footer.php');?>
