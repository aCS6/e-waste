<?php

	session_start();
	include("includes/db.php");

	if (isset($_GET['order_id'])) {
		$order_id = $_GET['order_id'];

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body bgcolor="#000000">
	<form action="confirm.php?update_id=<?php echo $order_id;   ?>" method="post">
		
		<table width="500" align="center" border="2" bgcolor="#cccccc">
			
			<tr >
				<td align="center" colspan="2"><h2>Please Confirm Your Payment</h2></td>
			</tr>
			<tr>
				<td>Invoice No:</td>
				<td><input type="text" name="invoice_no"></td>
			</tr>
			<tr>
				<td>Amount Sent</td>
				<td><input type="text" name="amount"></td>
			</tr>

			<tr>
				<td>Select Payment Mode:</td>
				<td>
					<select name="payment_method">
						<option value="">Select Payment</option>
						<option value="B-kash">B-kash</option>
						<option value="Rocket">Rocket</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Reference Code</td>
				<td><input type="text" name="code"></td>
			</tr>
			
			<tr>
				<td>Payment Date</td>
				<td><input type="text" name="date" placeholder="DD/MM/YYYY"></td>
			</tr>
			<tr align="center">
				<td colspan="5">
					<input type="submit" name="confirm" value="Confirm Payment">
				</td>
			</tr>
		</table>

	</form>
</body>
</html>
<?php

if (isset($_POST['confirm'])) {
	$invoice_no = $_POST['invoice_no'];
	$amount = $_POST['amount'];
	$payment_method = $_POST['payment_method'];
	$code = $_POST['code'];
	$date = $_POST['date'];
	$Complete = 'Complete';

	$update_id = $_GET['update_id'];



	$q = " INSERT INTO `payments`(`invoice_no`, `amount`, `payment_mode`, `code`, `payment_date`) VALUES ('$invoice_no','$amount','$payment_method','$code','$date') ";
	$r = mysqli_query($conn,$q);




	if ($r) {
		echo " <h2 style = 'text-align: center; color:white;' >Payment received, Your order will be completed withnin 24 hours </h2> ";

		$update_order = " update customer_orders set order_status='$Complete' where order_id='$update_id' ";

		$run = mysqli_query($conn,$update_order);
	}
	
}


?>