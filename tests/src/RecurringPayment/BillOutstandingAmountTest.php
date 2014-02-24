<?php
namespace PayPalPaymentsProClassicLite\RecurringPayment;
require_once(__DIR__.'/../../../src/RecurringPayment/BillOutstandingAmount.php');

class BillOutstandingAmountTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$rp = new BillOutstandingAmount();
		//Test instance
		$this->assertTrue($rp instanceof BillOutstandingAmount);
		
		//Test validation parameters
		$this->assertNotEmpty($rp->getValidationParameters());
		
		$variables = $rp->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'BillOutstandingAmount');
		
		
	}
	
	public function testExecuteCall()
	{
		//Cant test because we cant automate the paypalredirect
		return true;
		
	}
	
}