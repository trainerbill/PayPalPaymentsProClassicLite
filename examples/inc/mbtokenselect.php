<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-resource.js"></script>
<script type="text/javascript">

	var application = angular.module('application', ["ngResource"])
	.factory('TokenResource', function ($resource) {

	    return $resource(<?php ((file_exists('../inc/async-token.php')) ? print '\'../inc/async-token.php\'' : print '\'../../inc/async-token.php\'' )?>, {}, {
	        
	        get: {method: 'get', params: {}}

	    });
	})
	.controller('Token', function ($scope, $filter, TokenResource) {
		$scope.execute = function () {
			
			//Mini browser initing
		    PAYPAL.apps.Checkout.initXO();

			TokenResource.get({}, function (data) {
				var url = 'https://www.sandbox.paypal.com/checkoutnow?useraction=<?php echo $setec->expresscheckout_settings['useraction'] ?>&token=' + data.token;

				//Start MiniBrowser
				PAYPAL.apps.Checkout.startFlow(url);
			},
			function (data) {
				//Gracefully Close the minibrowser in case of AJAX errors
		        PAYPAL.apps.Checkout.closeFlow();
			});
		};
	});
</script>

<div data-ng-app="application" data-ng-controller="Token">
	Select how you want to get the EC-Token
	<select data-ng-model="requesttype" class="form-control">
	  <option value=""></option>
	  <option value="normal">Normal</option>
	  <option value="ajax">Ajax</option>
	</select>
	<div data-ng-show="requesttype === 'normal'">
		<a href="https://www.sandbox.paypal.com/checkoutnow?useraction=<?php echo $setec->expresscheckout_settings['useraction'] ?>&token=<?php echo $rvars['TOKEN']?>" data-paypal-button="true"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></a>
	</div>
	<div data-ng-show="requesttype === 'ajax'">
		<a data-ng-click="execute()"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></a>
	</div>
</div>
