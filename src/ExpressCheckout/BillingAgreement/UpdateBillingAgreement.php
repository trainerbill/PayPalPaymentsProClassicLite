<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement;
include_once(__DIR__.'/../../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class UpdateBillingAgreement extends PayPalAPI{
	
	public function __construct()
	{
		parent::__construct();
		
		//Set Method
		$this->call_variables['METHOD'] = 'BillAgreementUpdate';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'REFERENCEID',
		);
		
		
		
	}
	
}