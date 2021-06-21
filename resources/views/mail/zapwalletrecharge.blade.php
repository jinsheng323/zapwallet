<!doctype html>
<html lang='en'>
<body>
	<div>
		<p>Dear {{ $name}}</p>
        <p>Your {{ $rechargeType }} recharge has been successfully made through <b>ZAP</b>Wallet.</p>
		<br>
        <p>Transaction Details of {{ $rechargeType }}</p>
		<p>Transaction ID : {{ $transactionId }}</p>
		<p>Recharge Number : {{ $number }}</p>
		<p>Date : {{ date('d/m/Y h:i A') }}</p>
		<p>Amount: {{ $amount }}</p>
		<p>Current wallet balance : {{ $walletBalance }}</p>

		<br><br>
		<p>In case you have not received the recharge, you can click on the Dispute button which is available in the order history page.</p>
		<p>In case of any amount deducted for failed transaction may be refunded within 7 working days.</p>
		<p>In case of any queries, please write us at admin@zapwallet.in</p>
		<br>
		<p>Thanks for using zapwallet</p>
		<p>Thanks</p>
	</div>
</body>

</html>
