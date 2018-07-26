<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/script.js"></script>
		<script>
		</script>
		<title>.:TRY:.</title>
	</head>

	<body>
		<form method=post action=https://api-3t.sandbox.paypal.com/nvp>
		<input type=hidden name=USER value=API_username>
		<input type=hidden name=PWD value=API_password>
		<input type=hidden name=SIGNATURE value=API_signature>
		<input type=hidden name=VERSION value=XX.0>
		<input type=hidden name=PAYMENTREQUEST_0_PAYMENTACTION
			value=Sale>
		<input name=PAYMENTREQUEST_0_AMT value=19.95>
		<input type=hidden name=RETURNURL
			value=https://www.YourReturnURL.com>
		<input type=hidden name=CANCELURL
			value=https://www.YourCancelURL.com>
		<input type=submit name=METHOD value=SetExpressCheckout>
	</form>
	</body>
</html>
