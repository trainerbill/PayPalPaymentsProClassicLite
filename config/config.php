<?php
$config = array(
		/*
		To get Production Credentials:
			1. Login to Paypal.com
			2. Copy this into your browser
			3. https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_profile-api-access
			4. Click Request API credentials
			5. Select Request API Signature
			6. Click Agree and Submit
			7. Copy your API username, password, and signature.
			
		To get Sandbox Credentials:
			1. Go to developer.paypal.com and login or create an account
			2. Click Applications
			3. Click Sandbox accounts
			4. Click Create Accounts
			5. Create a business account
			6. Use any email address, it can even be fake.
			7. Just use 123456789 as your password.
			8. Once created click the arrow next to the newly created account on the Applications tab
			9. Click Profile
			10. Click Api Credentials
		*/

		'credentials' => array(
			'production' => array(
				'USER'	=>	'',         //Your User
				'PWD'	=>	'',         //Your Password
				'SIGNATURE'	=> '',      //Your signature
			),
			'sandbox' => array(
				'USER'	=>	'',         //Your User
				'PWD'	=>	'',         //Your Password
				'SIGNATURE'	=> '',      //Your signature
			),
		),

		'environment' => 'production',
		'environment' => 'sandbox', 	//Uncomment for sandbox testing
		
		'experience' => 'redirect'		//Values are "redirect" for the classic redirect or "lightbox" for lightbox

);