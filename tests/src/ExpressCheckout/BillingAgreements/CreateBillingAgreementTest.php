<?php
namespace PayPalPaymentsProClassicLite\ExpressCheckout\BillingAgreement;
require_once(__DIR__.'/../../../../src/ExpressCheckout/BillingAgreement/CreateBillingAgreement.php');
require_once(__DIR__.'/../../../../src/ExpressCheckout/SetExpressCheckout.php');
use PayPalPaymentsProClassicLite\ExpressCheckout\SetExpressCheckout;
class CreateBillingAgreementTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$ba = new CreateBillingAgreement();
		//Test instance
		$this->assertTrue($ba instanceof CreateBillingAgreement);
		
		//Test validation parameters
		$this->assertNotEmpty($ba->getValidationParameters());
		
		$variables = $ba->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'CreateBillingAgreement');
		
		
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
		
		$ba = new CreateBillingAgreement();
		$variables = array(
			'TOKEN' => $response['TOKEN'],
		);
		$ba->pushVariables($variables);
		$ba->executeCall();
		$response = $setec->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}