<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require_once(__DIR__.'/../../../src/RecurringPayment/CreateRecurringPaymentProfile.php');

class CreateRecurringPaymentProfileTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rp = new CreateRecurringPaymentProfile();
		//Test instance
		$this->assertTrue($rp instanceof CreateRecurringPaymentProfile);
		
		//Test validation parameters
		$this->assertNotEmpty($rp->getValidationParameters());
		
		$variables = $rp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'CreateRecurringPaymentsProfile');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test because we cant automate the paypalredirect
		return true;
		
	}
	
}