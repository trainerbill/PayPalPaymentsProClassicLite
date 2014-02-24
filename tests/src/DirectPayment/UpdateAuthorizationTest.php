<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/DirectPayment/UpdateAuthorization.php');
class UpdateAuthorizationTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$updateauth = new UpdateAuthorization();
		//Test instance
		$this->assertTrue($updateauth instanceof UpdateAuthorization);
		
		//Test validation parameters
		$this->assertNotEmpty($updateauth->getValidationParameters());
		
		$variables = $updateauth->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'UpdateAuthorization');
		
		
	}
	/*
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
		
		//Update Auth
		$updateauth = new UpdateAuthorization();
		$variables = array(
			'TRANSACTIONID' => $response['TRANSACTIONID'],
			'SHIPTONAME' => 'Wilma Flintstone',
			'SHIPTOSTREET' => '789 OK Street',
			'SHIPTOCITY' => 'Detroit',
			'SHIPTOSTATE' => 'MI',
			'SHIPTOZIP' => '48201',
			'SHIPTOCOUNTRY' => 'US',
		);
		$updateauth->pushVariables($variables);
		$updateauth->executeCall();
		$response = $updateauth->getCallResponseDecoded();
		print_r($response);
		$this->assertEquals($response['ACK'],'Success');
	}
	*/
}