<?php
namespace PayPalPaymentsProClassicLite\TransactionQuery;
require_once(__DIR__.'/../../../src/TransactionQuery/TransactionSearch.php');

class TransactionSearchTest extends \PHPUnit_Framework_TestCase
{
	public function testObjectConstruction()
	{
		$ts = new TransactionSearch();
		//Test instance
		$this->assertTrue($ts instanceof TransactionSearch);
		
		//Test validation parameters
		$this->assertNotEmpty($ts->getValidationParameters());
		
		$variables = $ts->getCallVariables();
		//Test default values
		$this->assertEquals($variables['METHOD'],'TransactionSearch');
		
		
	}
	
	public function testExecuteCall()
	{
		//Transaction Search
		$ts = new TransactionSearch();
		$variables = array(
			'STARTDATE' => date('Y-m-d\TG:i:s',strtotime('-15minutes')),		//Set Start date to a week ago
			'ENDDATE' => date('Y-m-d\TG:i:s'),								//Set End Date to now
		);
		$ts->pushVariables($variables);
		$ts->executeCall();
		$response = $ts->getCallResponseDecoded();
		print_r($response);
		$this->assertEquals($response['ACK'],'Success');
	}
	
}