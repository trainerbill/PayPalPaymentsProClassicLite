<?php
namespace PayPalExpressCheckoutLite;
include_once('SetExpressCheckout.php');
class SetExpressCheckoutBML extends SetExpressCheckout{
	
	public function __construct()
	{
		parent::__construct();
		
		//Setup BML variables
		$this->call_variables['UserSelectedFundingSource'] = 'BML';
		$this->call_variables['SOLUTIONTYPE'] = 'SOLE';
		
	}
	
}