<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement;
include_once(__DIR__.'/../../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class CreateBillingAgreement extends PayPalAPI{
	
	public function __construct()
	{
		parent::__construct();
		
		//Set Method
		$this->call_variables['METHOD'] = 'CreateBillingAgreement';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'METHOD',
				'TOKEN',
		);
		
		
		
	}
	
}