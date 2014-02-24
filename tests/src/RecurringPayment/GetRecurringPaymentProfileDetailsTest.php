<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require_once(__DIR__.'/../../../src/RecurringPayment/ManageRecurringPaymentProfileStatus.php');

class ManageRecurringPaymentProfileStatusTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rp = new ManageRecurringPaymentProfileStatus();
		//Test instance
		$this->assertTrue($rp instanceof ManageRecurringPaymentProfileStatus);
		
		//Test validation parameters
		$this->assertNotEmpty($rp->getValidationParameters());
		
		$variables = $rp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'ManageRecurringPaymentsProfileStatus');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test because we cant automate the paypalredirect
		return true;
		
	}
	
}