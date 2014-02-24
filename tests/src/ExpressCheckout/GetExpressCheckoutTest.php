<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/GetExpressCheckout.php');
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');
class GetExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$getec = new GetExpressCheckout();
		//Test instance
		$this->assertTrue($getec instanceof GetExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($getec->getValidationParameters());
		
		$variables = $getec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'GetExpressCheckoutDetails');
		
		
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
		
		$getec = new GetExpressCheckout();
		$variables = array(
				
			'TOKEN' => $response['TOKEN'],
			
		);
		$getec->pushVariables($variables);
		$getec->executeCall();
		$response = $getec->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}