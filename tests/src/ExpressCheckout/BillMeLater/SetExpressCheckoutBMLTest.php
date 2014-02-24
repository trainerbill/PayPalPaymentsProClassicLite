<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillMeLater;
require_once(__DIR__.'/../../../../src/ExpressCheckout/BillMeLater/SetExpressCheckoutBML.php');

class SetExpressCheckoutBMLTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$setec = new SetExpressCheckoutBML();
		//Test instance
		$this->assertTrue($setec instanceof SetExpressCheckoutBML);
		
		//Test validation parameters
		$this->assertNotEmpty($setec->getValidationParameters());
		
		$variables = $setec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'SetExpressCheckout');
		$this->assertEquals($variables['UserSelectedFundingSource'],'BML');
		$this->assertEquals($variables['SOLUTIONTYPE'],'SOLE');
		
	}
	
	public function testExecuteCall()
	{
		$setec = new SetExpressCheckoutBML();
		$variables = array(
				
			'RETURNURL' => 'http://localhost',
			'CANCELURL' => 'http://localhost',
			'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
			'PAYMENTREQUEST_0_AMT' => '10.00',
			'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
		);
		$setec->pushVariables($variables);
		$setec->executeCall();
		$response = $setec->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}