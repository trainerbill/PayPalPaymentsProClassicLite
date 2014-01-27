<?php
namespace PayPalPaymentsProClassicLite\TransactionQuery;
include_once(__DIR__.'/../PayPalAPI.php');
use PayPalPaymentsProClassicLite\PayPalAPI;
class GetTransactionDetails extends PayPalAPI{

	//Validation Variables
	protected $validation_parameters;
	
	public function __construct()
	{
		parent::__construct();
		//Set Method
		$this->call_variables['METHOD'] = 'GetTransactionDetails';
		
		//setup validation parameters.  Make sure these are present before executing call.
		$this->validation_parameters = array(
				'TRANSACTIONID',
		);
		
	}
	
}