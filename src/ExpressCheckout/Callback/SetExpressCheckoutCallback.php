<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\Callback;
include_once(__DIR__.'/../SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;
class SetExpressCheckoutCallback extends SetExpressCheckout{
	
	public function __construct()
	{
		parent::__construct();
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'CALLBACK',
				'MAXAMT',
				'CALLBACKTIMEOUT',
				'L_SHIPPINGOPTIONAMOUNT0',
				'L_SHIPPINGOPTIONNAME0',
				'L_SHIPPINGOPTIONISDEFAULT0',
				'PAYMENTREQUEST_0_AMT',
				'PAYMENTREQUEST_0_ITEMAMT',
				'PAYMENTREQUEST_0_SHIPPINGAMT',
		);
		
	}
	
}