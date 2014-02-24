<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');

class DoDirectPaymentTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$ddp = new DoDirectPayment();
		//Test instance
		$this->assertTrue($ddp instanceof DoDirectPayment);
		
		//Test validation parameters
		$this->assertNotEmpty($ddp->getValidationParameters());
		
		$variables = $ddp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoDirectPayment');
		
		
	}
	
	public function testExecuteCall()
	{
		$ddp = new DoDirectPayment();
		$variables = array(
				
			'PAYMENTACTION' => 'Sale',
			'IPADDRESS' => '127.0.0.1',
			'ACCT'=>'4556506716983263',
			'EXPDATE' => '112020',
			'CVV2' => '111',
			'FIRSTNAME' => 'Fred',
			'LASTNAME' => 'Flintstone',
			'STREET'=>'123 Bedrock Cir',
			'CITY'=>'Hollywood',
			'STATE' => 'CA',
			'COUNTRYCODE' => 'US',
			'ZIP' => '90210',
			'AMT' => '3.00'		
		);
		$ddp->pushVariables($variables);
		$ddp->executeCall();
		$response = $ddp->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}