<?php
	include("includes/db.php");
	include("functions/functions.php");
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>The Last of the hill</title>
	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>

	<!--main content starts-->
	<div class="main_wrapper">

		<!-- Header Starts -->
		<div class="header_wrapper">
			<a href="index.php"><img src="images/logo.png" style="float: left; height: 100px;width: 100px;margin-right: 20px;"></a>
			<img src="images/title.png" style="float: left;margin-right: 30px;">
			<img src="images/d.png" style="float: left;height: 100px;width: 100px;border-radius: 50%;margin-right: 20px;">


		</div>
		<!-- Header Ends -->

		<!-- Navigation Bar starts -->
		<div id="navBar">
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="my_account.php">My Account</a></li>
				<?php
				if(!isset($_SESSION['customer_email'])) {
					?>
						<li><a href="user_register.php">Sign up</a></li>
				<?php } ?>
				<li><a href="cart.php">Shopping Cart</a></li>
				<li><a href="contact.php">Contact Us</a></li>
			</ul>
			<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search product" required="">
					<input type="submit" name="search" value="Search">
				</form>
			</div>
		</div>
		<!-- Navigation Bar ends -->


		<div class="content_wrapper">
			<div id="left_sidebar">
				<div id="sidebar_title">Catagories</div>
				<ul id="cats">
					<?php getCat() ?>
				</ul>
				<div id="sidebar_title">Brands</div>
				<ul id="cats">
					<?php getBrands() ?>
				</ul>

			</div>
			<div id="right_content">
				<?php cart() ?>
				<div id="headline">
					<div id="headline_content">
						<b>Welcome Guest!</b>
						<b style="color: yellow;">Shopping Cart: </b>
						<span>- Toatal Items: <?php items();  ?> - Toatal Price: <?php total_price() ; ?> ::<a href="cart.php" style="color: #FF0;">Go To Cart</a>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
						
						 </span>
					</div>
				</div>

				<div align="middle">
						<form action="customer_register.php" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td colspan="8" align="center"><h2>Create an Account</h2></td>
								</tr>
								<tr>
									<td><b>Customer Name:</b></td>
									<td><input type="text" name="c_name" required></td>
								</tr>
								<tr>
									<td><b>Customer Email:</b></td>
									<td><input type="text" name="c_email" required></td>
								</tr>
								<tr>
									<td><b>Customer Password:</b></td>
									<td><input type="text" name="c_pass" required></td>
								</tr>
								<tr>
									<td><b>Customer Country:</b></td>
									<td>
										<select name="c_country" required="">
											<option value="">Select a Country</option>
											<option value="Bangladesh">Bangladesh</option>
											<option value="India">India</option>
											<option value="Maldeves">Maldeves</option>
											<option value="Sri Lanka">Sri Lanka</option>
											
										</select>
									</td>
								</tr>
								<tr>
									<td><b>Customer City:</b></td>
									<td><input type="text" name="c_city" required></td>
								</tr>
								<tr>
									<td><b>Customer Mobile:</b></td>
									<td><input type="text" name="c_contact" required></td>
								</tr>
								<tr>
									<td><b>Customer Address:</b></td>
									<td><input type="text" name="c_address" required></td>
								</tr>
								<tr>
									<td><b>Customer Image:</b></td>
									<td><input type="file" name="c_image" required></td>
								</tr>
								<tr>
									<td colspan="8" align="center">
										<input type="submit" name="register" value="Submit">
									</td>
								</tr>
								
							</table>
						</form>
				</div>
			</div>

		<div class="footer">
			<h1 style="color: #000;padding-top: 30px;text-align: center;">&copy; 2019 - By www.tlh.com</h1>
		</div>



	</div>
	<!--main content ends-->
</body>
</html>



<?php
	if(isset($_POST['register'])){
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
		$c_image = $_FILES['c_image']['name'];
		$c_img_tmp = $_FILES['c_image']['tmp_name'];

		$c_ip = getRealIpAddr();

		$insert_customer = " INSERT INTO `customers`( `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `cust_image`, `customer_ip`) VALUES ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip') ";
		$run_customer = mysqli_query($conn,$insert_customer);
		move_uploaded_file($c_img_tmp, "customer/customer_image/$c_image");

		$sel_cart = "select * from cart where ip_add = ' $c_ip '" ;
		$run_cart = mysqli_query($conn,$sel_cart);
		$check_cart = mysqli_num_rows($run_cart );

		if($check_cart>0){
			$_SESSION['customer_email']=$c_email;
			echo " <script> alert('Account Created Successfully, Thank You !') </script>  ";
			echo "<script> window.open('checkout.php','_self')</script>";
		}
		else{
			$_SESSION['customer_email']=$c_email;
			echo " <script> alert('Account Created Successfully, Thank You !') </script>  ";
			echo "<script> window.open('index.php','_self')</script>";
		}
		
	}


?>

