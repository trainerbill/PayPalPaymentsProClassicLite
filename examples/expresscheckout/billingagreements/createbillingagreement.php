<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement;
require(__DIR__.'/../../../src/ExpressCheckout/BillingAgreement/CreateBillingAgreement.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement\CreateBillingAgreement;

//Create Set Express Checkout class
$cba = new CreateBillingAgreement();

if(!isset($_GET['token']))
	die('Token not set.  You must do a Set Express Checkout First.');

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/
$variables = array(
	'TOKEN' => $_GET['token'],
);

//Place the variables onto the stack
$cba->pushVariables($variables);

//Execute the Call via CURL
$cba->executeCall();

//Get Submit String
$sstring = $cba->getCallQuery();

//Submitted Variables
$svars = $cba->getCallVariables();

//Get the response decoded into an array
$rvars = $cba->getCallResponseDecoded();

//Get the raw response
$rstring = $cba->getCallResponse();

//Get Endpoint
$endpoint = $cba->getCallEndpoint();

include('../../inc/apicalloutput.php');
?>

<a href="../../index.php">Back to Home</a><br/>
<a href="updatebillingagreement.php?baid=<?php echo $rvars['BILLINGAGREEMENTID']?>">Update Billing Agreement</a><br/>
<a href="../../referencetransactions/rt.php?baid=<?php echo $rvars['BILLINGAGREEMENTID']?>">Do Reference Transaction</a>