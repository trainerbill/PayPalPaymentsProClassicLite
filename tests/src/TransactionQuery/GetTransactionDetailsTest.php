<?php
namespace PayPalPaymentsProClassicLite\TransactionQuery;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/TransactionQuery/GetTransactionDetails.php');
use PayPalPaymentsProClassicLite\DirectPayment\DoDirectPayment;
class GetTransactionDetailsTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$tq = new GetTransactionDetails();
		//Test instance
		$this->assertTrue($tq instanceof GetTransactionDetails);
		
		//Test validation parameters
		$this->assertNotEmpty($tq->getValidationParameters());
		
		$variables = $tq->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'GetTransactionDetails');
		
		
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
		
		//Query Transaction
		$tq = new GetTransactionDetails();
		$variables = array(
			'TRANSACTIONID' => $response['TRANSACTIONID'],
			
		);
		$tq->pushVariables($variables);
		$tq->executeCall();
		$response = $tq->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}