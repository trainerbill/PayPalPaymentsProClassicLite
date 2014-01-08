<?php
namespace DoEC;
require('../src/DoExpressCheckout.php');
use PayPalExpressCheckoutLite\DoExpressCheckout;

//Create Get Express Checkout class
$doec = new DoExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
$variables = array(
	'TOKEN' => $_GET['token'],			//GET token
	'PAYERID' => $_GET['payerid'],		//GET Payerid
	'VERSION' => '109.0',
	'PAYMENTREQUEST_0_AMT' => '100.00',
);

//Place the variables onto the stack
$doec->pushVariables($variables);

//Execute the Call via CURL
$doec->executeCall();

//Get the response decoded into an array
$response = $doec->getCallResponseDecoded();

//Get the raw response
$string = $doec->getCallResponse();
?>
<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $doec->getCallEndpoint() ?> -d "<?php echo $doec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $doec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $doec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>

<a href="index.php">Back to Menu</a>