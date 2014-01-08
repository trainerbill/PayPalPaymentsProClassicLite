<?php
namespace PayPalExpressCheckoutLite;
include_once('PayPalExpressCheckout.php');
class DoReferenceTransaction extends PayPalExpressCheckout{
	
	//Method
	protected $method;
	
	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->method = 'DoReferenceTransaction';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'REFERENCEID',
				'PAYMENTACTION',
				'VERSION',
				'AMT',
		);
		
	}
	
}