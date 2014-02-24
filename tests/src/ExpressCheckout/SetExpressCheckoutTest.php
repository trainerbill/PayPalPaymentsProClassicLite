<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');

class SetExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$setec = new SetExpressCheckout();
		//Test instance
		$this->assertTrue($setec instanceof SetExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($setec->getValidationParameters());
		
		$variables = $setec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'SetExpressCheckout');
		
		
	}
	
	public function testExecuteCall()
	{
		$setec = new SetExpressCheckout();
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