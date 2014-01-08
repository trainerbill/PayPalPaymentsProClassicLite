<?php
namespace GetEC;
require('../src/GetExpressCheckout.php');
use PayPalExpressCheckoutLite\GetExpressCheckout;

//Create Get Express Checkout class
$getec = new GetExpressCheckout();

//Place any variables into this array:  https://developer.paypal.com/webapps/developer/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
$variables = array(
		'TOKEN' => $_GET['token'],	//GET token from URL
		'VERSION' => '109.0'
);

//Place the variables onto the stack
$getec->pushVariables($variables);

//Execute the Call via CURL
$getec->executeCall();

//Get the response decoded into an array
$response = $getec->getCallResponseDecoded();

//Get the raw response
$string = $getec->getCallResponse();
?>

<h3>Submitted</h3>
<div style="max-width:800px;word-wrap:break-word;">curl -i <?php echo $getec->getCallEndpoint() ?> -d "<?php echo $getec->getCallQuery() ?>" </div>

<h3>Return String</h3>
<div style="max-width:800px;word-wrap:break-word;"><?php echo $getec->getCallResponse() ?></div>

<h3>Return Decoded</h3>
<pre>
<?php
$decoded = $getec->getCallResponseDecoded();
print_r($decoded);
?>
</pre>

<?php if($getec->getCheckoutExperience() == 'lightbox'):?>
<script>
    (function(d, s, id){
      var js, ref = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)){
        js = d.createElement(s); js.id = id; js.async = true;
        js.src = "//www.paypalobjects.com/js/external/paypal.js";
        ref.parentNode.insertBefore(js, ref);
      }
    }(document, "script", "paypal-js"));
  </script>

   <script>
if (window != top) {
top.location.replace(document.location);
}
</script>
<?php endif;?>


<a href="doexpresscheckout.php?token=<?php echo $response['TOKEN'] ?>&payerid=<?php echo $_GET['PayerID']?>">Do Express Checkout</a>
