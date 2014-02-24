<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout;
require_once(__DIR__.'/../../../src/ExpressCheckout/DoExpressCheckout.php');
require_once(__DIR__.'/../../../src/ExpressCheckout/SetExpressCheckout.php');
class DoExpressCheckoutTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$doec = new DoExpressCheckout();
		//Test instance
		$this->assertTrue($doec instanceof DoExpressCheckout);
		
		//Test validation parameters
		$this->assertNotEmpty($doec->getValidationParameters());
		
		$variables = $doec->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoExpressCheckoutPayment');
		
		
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
		
		$doec = new DoExpressCheckout();
		$variables = array(
			'TOKEN' => $response['TOKEN'],
			'PAYERID' => 'QCHNYJU6PLMZE',
			'PAYMENTREQUEST_0_AMT' => '10.00',
		);
		$doec->pushVariables($variables);
		$doec->executeCall();
		$response = $doec->getCallResponseDecoded();
		
		$this->assertEquals($response['L_ERRORCODE0'],'10485');
	}
	
}