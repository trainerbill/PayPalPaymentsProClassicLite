<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoNonReferencedCredit.php');

class DoNonReferencedCreditTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$non = new DoNonReferencedCredit();
		//Test instance
		$this->assertTrue($non instanceof DoNonReferencedCredit);
		
		//Test validation parameters
		$this->assertNotEmpty($non->getValidationParameters());
		
		$variables = $non->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoNonReferencedCredit');
		
		
	}
	
	public function testExecuteCall()
	{
		$non = new DoNonReferencedCredit();
		$variables = array(
				
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
			'AMT' => '3.00',
			'CURRENCYCODE' => 'USD'	
		);
		$non->pushVariables($variables);
		$non->executeCall();
		$response = $non->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}