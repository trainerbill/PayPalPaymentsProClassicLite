<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/DoReauthorization.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoReauthorization;

if(!isset($_GET['trxid']))
	die('You have to have a transaction id.');

//Create Get Express Checkout class
$dcc = new DoReauthorization();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoReauthorization_API_Operation_NVP/
$variables = array(
	'AUTHORIZATIONID' => $_GET['trxid'],
	'AMT' => '200.00',
);

//Place the variables onto the stack
$dcc->pushVariables($variables);

//Execute the Call via CURL
$dcc->executeCall();

//Get Submit String
$sstring = $dcc->getCallQuery();

//Submitted Variables
$svars = $dcc->getCallVariables();

//Get the response decoded into an array
$rvars = $dcc->getCallResponseDecoded();

//Get the raw response
$rstring = $dcc->getCallResponse();

//Get Endpoint
$endpoint = $dcc->getCallEndpoint();

include('../inc/apicalloutput.php');
?>

<h3 style="color:red">Reauthorization can only take place after the honor period which is 3 days be default.</h3>

<a href="../index.php">Back to Menu</a><br/>

<?php if($rvars['ACK'] == 'Success'):?>
<a href="void.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Void Transaction</a><br/>
<a href="capture.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Capture Transaction</a><br/>
<a href="../referencetransactions/rt.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Do Reference Transaction</a><br/>
<div><a href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['TRANSACTIONID'] ?>">Get Transaction Details</a></div>
<?php endif;?>