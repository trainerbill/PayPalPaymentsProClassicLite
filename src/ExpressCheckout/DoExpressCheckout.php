<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
include_once(__DIR__.'/../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class DoExpressCheckout extends PayPalAPI{
	
	
	
	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->call_variables['METHOD'] = 'DoExpressCheckoutPayment';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'TOKEN',
				'VERSION',
				'PAYERID',
				'PAYMENTREQUEST_0_AMT',
		);
		
	}
	
}