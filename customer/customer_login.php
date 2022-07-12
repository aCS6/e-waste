<?php
include("includes/db.php");
 @session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<h2 align="center"><u>Login Or Register</u></h2><br>
		<form action="checkout.php" method="post">
			<table width="800" bgcolor="#66cccc" align="center">	
			<tr>
				<td><b>Your Email : </b></td>
				<td><input type="text" name="c_email" placeholder="Enter your email"></td>
			</tr>
			<tr>
				<td><b>Your Password : </b></td>
				<td><input type="password" name="c_pass" ></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<a href="forgot_pass.php">Forgot Password</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="c_login" value="Login" >
				</td>
			</tr>								
			</table>

			<h2 style="float: right;padding: 10px;">New?<a href="customer_register.php"> Register here</a></h2>

		</form>
	</div>
</body>
</html>
<?php
	if (isset($_POST['c_login'])) {
		$customer_email = $_POST['c_email'];
		$customer_pass= $_POST['c_pass'];
		
		$select_customer = " select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass' ";
		$run = mysqli_query($conn,$select_customer);

		$check_customer = mysqli_num_rows($run);
		$get_ip = getRealIpAddr();
		$sel_cart = "select * from cart where ip_add = ' $get_ip '" ;
		$run_cart = mysqli_query($conn,$sel_cart);
		$check_cart = mysqli_num_rows($run_cart );

		if($check_customer==0){
			echo " <script> alert('Password or Email address is not correct, try again.!') </script>  ";
			exit();
		}
		
		else{
			$_SESSION['customer_email']=$customer_email;
			echo " <script> alert('You succsessfully login , You can Order.') </script>  ";
			include("payment_options.php");
		}

	}


?>
