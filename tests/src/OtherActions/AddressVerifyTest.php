<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require_once(__DIR__.'/../../../src/OtherActions/AddressVerify.php');

class AddressVerifyTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$av = new AddressVerify();
		//Test instance
		$this->assertTrue($av instanceof AddressVerify);
		
		//Test validation parameters
		$this->assertNotEmpty($av->getValidationParameters());
		
		$variables = $av->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'AddressVerify');
		
		
	}
	
	public function testExecuteCall()
	{
		$av = new AddressVerify();
		$variables = array(
			'EMAIL' => 'buyer@awesome.com',
			'STREET' => '1 Main St',
			'ZIP'	=> '95131',
		);
		$av->pushVariables($variables);
		$av->executeCall();
		$response = $av->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}