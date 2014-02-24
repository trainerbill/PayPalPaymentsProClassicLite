<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoDirectPayment.php');
require_once(__DIR__.'/../../../src/DirectPayment/DoCapture.php');
require_once(__DIR__.'/../../../src/DirectPayment/RefundTransaction.php');
class RefundTransactionTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$refund = new RefundTransaction();
		//Test instance
		$this->assertTrue($refund instanceof RefundTransaction);
		
		//Test validation parameters
		$this->assertNotEmpty($refund->getValidationParameters());
		
		$variables = $refund->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'RefundTransaction');
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
		
		//Do Refund
		$refund = new RefundTransaction();
		$variables = array(
				'TRANSACTIONID' => $response['TRANSACTIONID'],
				'REFUNDTYPE' => 'Full'
		);
		$refund->pushVariables($variables);
		$refund->executeCall();
		$response = $refund->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}