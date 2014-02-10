<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require(__DIR__.'/../../src/DirectPayment/UpdateAuthorization.php');
use PayPalPaymentsProClassicLite\DirectPayment\UpdateAuthorization;

if(!isset($_GET['trxid']))
	die('You have to have a transaction id.');

//Create Get Express Checkout class
$dcc = new UpdateAuthorization();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/UpdateAuthorization_API_Operation_NVP/
$variables = array(
	'TRANSACTIONID' => $_GET['trxid'],
	'SHIPTONAME' => 'Wilma Flintstone',
	'SHIPTOSTREET' => '789 OK Street',
	'SHIPTOCITY' => 'Detroit',
	'SHIPTOSTATE' => 'MI',
	'SHIPTOZIP' => '48201',
	'SHIPTOCOUNTRY' => 'US',
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

include(__DIR__.'/../inc/header.php');
include(__DIR__.'/../inc/apicalloutput.php');
?>

<a class="btn btn-default" href="../index.php">Back to Menu</a>
<?php if($rvars['ACK'] == 'Success'):?>
<a class="btn btn-default" href="void.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Void Transaction</a>
<a class="btn btn-default" href="capture.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Capture Transaction</a>
<a class="btn btn-default" href="../referencetransactions/rt.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Do Reference Transaction</a>
<a class="btn btn-default" href="reauthorization.php?trxid=<?php echo $rvars['TRANSACTIONID']?>">Reauthorize Transaction</a>
<a class="btn btn-default" href="../transactionquery/transactiondetails.php?trxid=<?php echo $rvars['TRANSACTIONID'] ?>">Get Transaction Details</a>
<?php endif;?>

<?php include(__DIR__.'/../inc/footer.php');?>