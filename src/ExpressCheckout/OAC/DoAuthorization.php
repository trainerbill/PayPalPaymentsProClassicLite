<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\OAC;
include_once(__DIR__.'/../../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class DoAuthorization extends PayPalAPI{

	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->call_variables['METHOD'] = 'DoAuthorization';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'TRANSACTIONID',
				'AMT'
		);
		
	}
	
}