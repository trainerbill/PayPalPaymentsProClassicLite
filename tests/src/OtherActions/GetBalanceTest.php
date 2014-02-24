<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require_once(__DIR__.'/../../../src/OtherActions/GetBalance.php');

class GetBalanceTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$gb = new GetBalance();
		//Test instance
		$this->assertTrue($gb instanceof GetBalance);
		
		$variables = $gb->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'GetBalance');
		
		
	}
	
	public function testExecuteCall()
	{
		$gb = new GetBalance();
		$variables = array(
			'RETURNALLCURRENCIES' => '1',
		);
		$gb->pushVariables($variables);
		$gb->executeCall();
		$response = $gb->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}