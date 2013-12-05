<?php
namespace PayPalExpressCheckout;
include('PayPalExpressCheckout.php');
class DoExpressCheckout extends PayPalExpressCheckout{
	
	//Method
	protected $method;
	
	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		//Set Method
		$this->method = 'DoExpressCheckoutPayment';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'TOKEN',
				'VERSION',
				'PAYERID',
				'PAYMENTREQUEST_0_AMT',
		);
		
	}
	
}