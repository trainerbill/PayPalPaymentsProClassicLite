<?php 
namespace PayPalExpressCheckoutLite;
class PayPalExpressCheckout {
	
	//Setup Variables
	protected $call_endpoint;
	
	//Call Variables
	protected $call_credentials;
	protected $call_query;
	protected $call_variables;
	protected $call_response;
	protected $call_response_decoded;
	
	protected $checkout_experience;
	
	
	public function __construct()
	{
		include(__DIR__.'/../config/config.php');
		if($config['environment'] == 'production')
		{
			$this->call_endpoint = 'https://api-3t.paypal.com/nvp';
			$this->setCredentials($config['credentials']['production']);
		}
		else
		{
			$this->call_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$this->setCredentials($config['credentials']['sandbox']);
		}
		
		$this->checkout_experience = $config['experience'];
	}
	
	//GET METHODS
	public function getCallResponse()
	{
		return $this->call_response;
	}
	
	public function getCallResponseDecoded()
	{
		return $this->call_response_decoded;
	}
	
	public function getCallEndpoint()
	{
		return $this->call_endpoint;
	}
	
	public function getCallQuery()
	{
		return $this->call_query;
	}
	
	public function getCallVariables()
	{
		return $this->call_variables;
	}
	
	public function getCheckoutExperience()
	{
		return $this->checkout_experience;
	}
	
	
	
	public function setCredentials($credentials)
	{
		if(!is_array($credentials))
			throw new \Exception(__METHOD__ . ': argument must be an array.');
		
		if(!array_key_exists('USER',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a USER key');
		
		if(!array_key_exists('PWD',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a PWD key');
		
		if(!array_key_exists('SIGNATURE',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a SIGNATURE key');
		
		$this->call_credentials = $credentials;		
	}
	
	public function pushVariables($variables)
	{
		if(!is_array($variables))
			throw new \Exception(__METHOD__ . ': argument must be an array.');
		
		foreach($variables as $key => $value)
		{
			$this->call_variables[$key] = $value;
		}
	}
	
	public function clearVariables()
	{
		$this->call_variables = array();
	}
	
	public function clearCredentials()
	{
		$this->call_credentials = array();
	}
	
	//Worker functions
	public function getApiString()
	{
		$string = '';
		foreach($this->call_credentials as $key => $value)
			$string .= $key . '=' . $value . '&';
		foreach($this->call_variables as $key => $value)
			$string .= $key . '=' . $value . '&';
		$string .= 'METHOD='.$this->method;
		$this->call_query = $string;
		return $string;
	}
	
	public function decodeReturn($inputdata = NULL)
	{
		if(!$inputdata)
			$inputdata = $this->call_response;
		
		$data = array();
		$key = explode('&',$inputdata);
		foreach($key as $temp)
		{
			$keyval = explode('=',$temp);
			if(isset($keyval[1]))
				$data[$keyval[0]] = $keyval[1];
		}
		$this->call_response_decoded = $data;
		return $data;
	}
	
	public function quickValidation()
	{
		
		foreach($this->validation_parameters as $key )
		{
			if(!array_key_exists($key,$this->call_variables))
				throw new \Exception(__METHOD__.': '.$key.' is listed as a required variable and not present in the call variables.');
		}
	}
	
	public function executeCall()
	{
		if(!is_array($this->call_credentials))
			throw new \Exception(__METHOD__.': You must use the setCredentials method before executing an api call.');
		
		$this->quickValidation();
		
		$string = $this->getApiString();
		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_URL,$this->call_endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $string);  //Set My query string
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$this->call_response =  curl_exec($ch);		//Execute the API Call
		$this->decodeReturn();
		
		return $this->call_response;
	}
	
}