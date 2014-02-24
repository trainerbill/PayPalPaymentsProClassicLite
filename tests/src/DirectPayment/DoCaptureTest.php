<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/DirectPayment/DoCapture.php');
class DoCaptureTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$capture = new DoCapture();
		//Test instance
		$this->assertTrue($capture instanceof DoCapture);
		
		//Test validation parameters
		$this->assertNotEmpty($capture->getValidationParameters());
		
		$variables = $capture->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoCapture');
		
		
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
		
		//Do Capture
		$capture = new DoCapture();
		$variables = array(
			'AUTHORIZATIONID' => $response['TRANSACTIONID'],
			'AMT' => '3.00',
			'COMPLETETYPE' => 'Complete',
		);
		$capture->pushVariables($variables);
		$capture->executeCall();
		$response = $capture->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}