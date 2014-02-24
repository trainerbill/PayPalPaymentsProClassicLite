<?php
namespace PayPalPaymentsProClassicLite\DirectPayment;
require_once(__DIR__.'/../../../src/DirectPayment/DoReauthorization.php');

class DoReauthorizationTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$reauth = new DoReauthorization();
		//Test instance
		$this->assertTrue($reauth instanceof DoReauthorization);
		
		//Test validation parameters
		$this->assertNotEmpty($reauth->getValidationParameters());
		
		$variables = $reauth->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'DoReauthorization');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test the actual call because the authorization needs to be 3 days old
	}
	
}