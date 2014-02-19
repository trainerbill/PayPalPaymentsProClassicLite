<?php include(__DIR__.'/inc/header.php');?>

<div class="row">
	<div class="col-md-12">
		<h3>Direct Payments</h3>
		<div><a href="directpayments/sale.php">Sale Transaction</a></div>
		<div><a href="directpayments/authorization.php">Authorization Transaction</a></div>
		<div><a href="directpayments/nonreferencedcredit.php">Do Non-Referenced Credit</a> - A credit with no previous PayPal Transaction ID</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Express Checkout</h3>
		<div><a href="expresscheckout/setexpresscheckout.php">Set Express Checkout</a></div>
		<div><a href="expresscheckout/setexpresscheckout-lineitems.php">Set Express Checkout - With Line Items</a></div>
		<div><a href="expresscheckout/billingagreements/setec.php">Create Billing Agreement</a></div>
		<div><a href="expresscheckout/recurringpayments/setec.php">Create Recurring Payments Profile</a></div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Bill Me Later</h3>
		<div><a href="expresscheckout/billmelater/bml.php">Bill Me Later SetEC</a></div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h3>Transaction Query</h3>
		<div><a href="transactionquery/transactionsearch.php">Transaction Search</a></div>
		<div><a href="transactionquery/transactiondetails.php">Get Transaction Details</a></div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<h3>Other Actions</h3>
		<div><a href="otheractions/addressverify.php">Verify PayPal Account Address</a> - You need special permission to use this api call.</div>
		<div><a href="otheractions/getbalance.php">Get Balance</a></div>
		<div><a href="otheractions/getpaldetails.php">Get Pal Details</a></div>
		<div><a href="otheractions/masspay.php">Mass Pay</a></div>
	</div>
</div>

<?php include(__DIR__.'/inc/footer.php');?>