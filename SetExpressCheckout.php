<?php
namespace PayPalExpressCheckoutLite;
include_once('PayPalExpressCheckout.php');
class SetExpressCheckout extends PayPalExpressCheckout{
	
	//Method
	protected $method;
	
	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		//Set Method
		$this->method = 'SetExpressCheckout';
		$this->call_endpoint = 'https://api-3t.paypal.com/nvp';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'RETURNURL',
				'CANCELURL',
				'PAYMENTACTION',
				'PAYMENTREQUEST_0_AMT',
				'CURRENCYCODE',
				'VERSION',
		);
		
	}
	
}