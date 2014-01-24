<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
include_once(__DIR__.'/../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class DoVoid extends PayPalAPI{

	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->call_variables['METHOD'] = 'DoVoid';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'AUTHORIZATIONID',
		);
		
	}
	
}