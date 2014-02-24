<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require_once(__DIR__.'/../../../src/RecurringPayment/UpdateRecurringPaymentProfile.php');

class UpdateRecurringPaymentProfileTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rp = new UpdateRecurringPaymentProfile();
		//Test instance
		$this->assertTrue($rp instanceof UpdateRecurringPaymentProfile);
		
		//Test validation parameters
		$this->assertNotEmpty($rp->getValidationParameters());
		
		$variables = $rp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'UpdateRecurringPaymentsProfile');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test because we cant automate the paypalredirect
		return true;
		
	}
	
}