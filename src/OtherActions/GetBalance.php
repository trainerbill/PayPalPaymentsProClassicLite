<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
include_once(__DIR__.'/../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class GetBalance extends PayPalAPI{

	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->call_variables['METHOD'] = 'GetBalance';
		
	}
	
}