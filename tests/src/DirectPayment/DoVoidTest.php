<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/DirectPayment/DoVoid.php');
class DoVoidTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$void = new DoVoid();
		//Test instance
		$this->assertTrue($void instanceof DoVoid);
		
		//Test validation parameters
		$this->assertNotEmpty($void->getValidationParameters());
		
		$variables = $void->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoVoid');
		
		
	}
	
	public function testExecuteCall()
	{
		//Do Authorization
		$ddp = new DoDirectPayment();
		$variables = array(
				
			'PAYMENTACTION' => 'Authorization',
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
		
		//Do Void
		$void = new DoVoid();
		$variables = array(
			'AUTHORIZATIONID' => $response['TRANSACTIONID'],
		);
		$void->pushVariables($variables);
		$void->executeCall();
		$response = $void->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}