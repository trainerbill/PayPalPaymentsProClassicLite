<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillMeLater;
include_once(__DIR__.'/../SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;
class SetExpressCheckoutBML extends SetExpressCheckout{
	
	public function __construct()
	{
		parent::__construct();
		
		//Setup BML variables
		$this->call_variables['UserSelectedFundingSource'] = 'BML';
		$this->call_variables['SOLUTIONTYPE'] = 'SOLE';
		
	}
	
}