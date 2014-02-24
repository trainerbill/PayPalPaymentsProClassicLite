<?php
namespace PayPalPaymentsProClassicLite\OtherActions;
require_once(__DIR__.'/../../../src/OtherActions/GetPalDetails.php');

class GetPalDetailsTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$pd = new GetPalDetails();
		//Test instance
		$this->assertTrue($pd instanceof GetPalDetails);
		
		
		$variables = $pd->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'GetPalDetails');
		
		
	}
	
	public function testExecuteCall()
	{
		$pd = new GetPalDetails();
		
		$pd->executeCall();
		$response = $pd->getCallResponseDecoded();
		
		$this->assertEquals($response['ACK'],'Success');
	}
	
}