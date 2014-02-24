<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require_once(__DIR__.'/../../../src/OtherActions/MassPay.php');

class MassPayTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$mp = new MassPay();
		//Test instance
		$this->assertTrue($mp instanceof MassPay);
		
		//Test validation parameters
		$this->assertNotEmpty($mp->getValidationParameters());
		
		$variables = $mp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'MassPay');
		
		
	}
	
	public function testExecuteCall()
	{
		$mp = new MassPay();
		$variables = array(
			'CURRENCYCODE' => 'USD',
			'RECEIVERTYPE' =>	'EmailAddress',
			'L_EMAIL0'	=> 'buyer@awesome.com',
			'L_AMT0'	=> '100.25',
			'L_EMAIL1'	=> 'buyer1@awesome.com',
			'L_AMT1'	=> '75.24',
			'L_EMAIL2'	=> 'seller1@awesome.com',
			'L_AMT2'	=> '50.87',
		);
		$mp->pushVariables($variables);
		$mp->executeCall();
		$response = $mp->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}