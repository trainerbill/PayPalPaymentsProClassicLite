<?php
namespace PayPalPaymentsProClassicLite;
require_once(__DIR__.'/../../src/PayPalAPI.php');

class PayPalAPITest extends \PHPUnit_Framework_TestCase
{
	
	public function testObjectConstruction()
	{
		$pp = new PayPalAPI();
		//Test instance
		$this->assertTrue($pp instanceof PayPalAPI);
		
		//Test Attributes
		$this->assertObjectHasAttribute('call_endpoint',$pp);
		$this->assertObjectHasAttribute('validation_parameters',$pp);
		$this->assertObjectHasAttribute('environment',$pp);
		$this->assertObjectHasAttribute('expresscheckout_settings',$pp);
		$this->assertObjectHasAttribute('call_credentials',$pp);
		$this->assertObjectHasAttribute('call_query',$pp);
		$this->assertObjectHasAttribute('call_variables',$pp);
		$this->assertObjectHasAttribute('call_response',$pp);
		$this->assertObjectHasAttribute('call_response_decoded',$pp);
		
		//Make sure endpoint is test
		$this->assertEquals($pp->getCallEndpoint(),'https://api-3t.sandbox.paypal.com/nvp');
		
	}
	
	public function testConfiguration()
	{
		//Test config file
		$this->assertFileExists(__DIR__.'/../../config/config.php');
		
		require(__DIR__.'/../../config/config.php');
		
		//Make sure environment exists
		$this->assertNotEmpty($config['environment']);
		
		//Make sure api version exists
		$this->assertNotEmpty($config['apiversion']);
		
		//Test Credentials
		$this->assertArrayHasKey('USER',$config['credentials']['sandbox']);
		$this->assertArrayHasKey('PWD',$config['credentials']['sandbox']);
		$this->assertArrayHasKey('SIGNATURE',$config['credentials']['sandbox']);
		$this->assertArrayHasKey('USER',$config['credentials']['production']);
		$this->assertArrayHasKey('PWD',$config['credentials']['production']);
		$this->assertArrayHasKey('SIGNATURE',$config['credentials']['production']);
		
		//Make sure sandbox credentials are set to my test credentials
		$this->assertEquals('seller_api1.awesome.com',$config['credentials']['sandbox']['USER']);
		$this->assertEquals('1374512372',$config['credentials']['sandbox']['PWD']);
		$this->assertEquals('Aj1PRxuNKRh0FhwjgrTLGnn515trAGwGZHW7KLOlOuyQom-IEXlq.w4w',$config['credentials']['sandbox']['SIGNATURE']);
		
		
	}
	
	
	
	public function testSetCredentials()
	{
		require(__DIR__.'/../../config/config.php');
		$pp = new PayPalAPI();
		$creds = $pp->setCredentials($config['credentials']['sandbox']);
		$this->assertArrayHasKey('USER',$creds);
		$this->assertArrayHasKey('PWD',$creds);
		$this->assertArrayHasKey('SIGNATURE',$creds);
	}
	
	public function testPushVariables()
	{
		$pp = new PayPalAPI();
		
		$variables = array(
			'TEST' => 'ME',
			'OKIE' => 'dokie'		
		);
		
		$pp->pushVariables($variables);
		
		$rvars = $pp->getCallVariables();
		$this->assertEquals($rvars['TEST'],'ME');
		$this->assertEquals($rvars['OKIE'],'dokie');
	}
	
	public function testClearVariables()
	{
		$pp = new PayPalAPI();
		$variables = array(
				'TEST' => 'ME',
				'OKIE' => 'dokie'
		);
		$pp->pushVariables($variables);
		$pp->clearVariables();
		
		//Test clear variables
		$this->assertEmpty($pp->getCallVariables());
	}
	
	public function testClearCredentials()
	{
		require(__DIR__.'/../../config/config.php');
		$pp = new PayPalAPI();
		$creds = $pp->setCredentials($config['credentials']['sandbox']);
		
		$pp->clearCredentials();
		
		//Test clear variables
		$this->assertEmpty($pp->getCredentials());
	}
	
	public function testGetApiString()
	{
		$pp = new PayPalAPI();
		
		$variables = array(
				'TEST' => 'ME',
				'OKIE' => 'dokie'
		);
		
		$pp->pushVariables($variables);
		$string = $pp->getApiString();
		$this->assertEquals('USER=seller_api1.awesome.com&PWD=1374512372&SIGNATURE=Aj1PRxuNKRh0FhwjgrTLGnn515trAGwGZHW7KLOlOuyQom-IEXlq.w4w&VERSION=109.0&TEST=ME&OKIE=dokie&',$string);
	}
	
	public function testDecodeReturn()
	{
		$pp = new PayPalAPI();
		
		$string="TEST=ME&OKIE=dokie&VERBOSITY=HIGH";
		$decode = $pp->decodeReturn($string);
		
		$this->assertEquals($decode,array(
			'TEST'=>'ME',
			'OKIE'=>'dokie',
			'VERBOSITY'=>'HIGH'
		));
	}
	
	/*
	public function testExecuteCall()
	{
		$pf = new PayFlowAPI();
		$pf->executeCall();
		
		//Test responses
		$this->assertNotEmpty($pf->getCallResponse());
		$this->assertNotEmpty($pf->getCallResponseDecoded());
		
		$response = $pf->getCallResponseDecoded();
		
		//Test PayPal Response.  We should get user authentication error.
		$this->assertEquals($response['RESULT'],1);
	}
	*/
}