<?php
namespace PayPalPaymentsProClassicLite\ReferenceTransaction;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/ReferenceTransaction/DoReferenceTransaction.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoDirectPayment;
class DoReferenceTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rt = new DoReferenceTransaction();
		//Test instance
		$this->assertTrue($rt instanceof DoReferenceTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($rt->getValidationParameters());
		
		$variables = $rt->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoReferenceTransaction');
		
		
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
		
		//Do Reference Transaction
		$rt = new DoReferenceTransaction();
		$variables = array(
			'REFERENCEID' => $response['TRANSACTIONID'],
			'PAYMENTACTION' => 'Sale',
			'AMT' => '20.00'
		);
		$rt->pushVariables($variables);
		$rt->executeCall();
		$response = $rt->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}