<!doctype html>
<html lang='en'>
<body>
	<div>
		<p>Dear {{ $name}}</p>
        <p>Your Add Money recharge has been successfully made through <b>ZAP</b>Wallet.</p>

        <p>Info bellow</p>
        <p>Date : {{ date('d/m/Y h:i A') }}</p>
        <p>Transaction Id : {{ $transaction_id }}</p>
        <p>Recharge Number : {{ $order }}</p>
        <p>Amount: {{ $amount }}</p>

		<br><br>
		<p>In case you have not received the recharge, you can click on the Dispute button which is available in the order history page.</p>
		<p>In case of any amount deducted for failed transaction may be refunded within 7 working days.</p>
		<p>In case of any queries, please write us at admin@zapwallet.in</p>
		<br>
		<p>Thanks for using zapwallet</p>
		

	</div>

</body>

</html>
