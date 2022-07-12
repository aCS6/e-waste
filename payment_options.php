<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include("includes/db.php");

	?>
	<div style="padding: 20px; ">
		<?php

			$email = $_SESSION['customer_email'];
			$get_customer = " select * from customers where customer_email='$email' ";
			$run = mysqli_query($conn,$get_customer);
			$customer = mysqli_fetch_array($run );

			$customer_id = $customer['customer_id'];

		?>
		<b>Pay With</b>&nbsp<br><a href="https://www.paypal.com/us/home"><img src="images/paypal.png" width="400px" height="100px"></a><br><br>
		<b>	Or <a href="order.php?c_id=<?php echo $customer_id; ?>">Pay Offline</a></b>
		<br><br>
		<b>Notice Please: If you selected "Pay Offline" option then please check your email or account to find the Invoice No. for your order</b>
	</div>
</body>
</html>