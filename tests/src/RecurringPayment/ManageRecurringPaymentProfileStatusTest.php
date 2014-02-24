<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require_once(__DIR__.'/../../../src/RecurringPayment/GetRecurringPaymentProfileDetails.php');

class GetRecurringPaymentProfileDetailsTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rp = new GetRecurringPaymentProfileDetails();
		//Test instance
		$this->assertTrue($rp instanceof GetRecurringPaymentProfileDetails);
		
		//Test validation parameters
		$this->assertNotEmpty($rp->getValidationParameters());
		
		$variables = $rp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'GetRecurringPaymentsProfileDetails');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test because we cant automate the paypalredirect
		return true;
		
	}
	
}