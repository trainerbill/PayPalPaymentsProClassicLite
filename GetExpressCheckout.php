<?php
namespace PayPalExpressCheckoutLite;
include_once('PayPalExpressCheckout.php');
class GetExpressCheckout extends PayPalExpressCheckout{
	
	//Method
	protected $method;
	
	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		//Set Method
		$this->method = 'GetExpressCheckoutDetails';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'TOKEN',
				'VERSION'
		);
		
	}
	
}