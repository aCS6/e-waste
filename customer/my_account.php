<?php
	include("includes/db.php");
	include("functions/functions.php");
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>The Last of the hill</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="all">
</head>
<body>

	<!--main content starts-->
	<div class="main_wrapper">

		<!-- Header Starts -->
		<div class="header_wrapper">
			<a href="../index.php"><img src="../images/logo.png" style="float: left; height: 100px;width: 100px;margin-right: 20px;"></a>
			<img src="../images/title.png" style="float: left;margin-right: 30px;">
			<img src="../images/d.png" style="float: left;height: 100px;width: 100px;border-radius: 50%;margin-right: 20px;">


		</div>
		<!-- Header Ends -->

		<!-- Navigation Bar starts -->
		<div id="navBar">
			<ul id="menu">
				<li><a href="../index.php">Home</a></li>
				<li><a href="../all_products.php">All Products</a></li>
				<li><a href="my_account.php">My Account</a></li>
				<?php
				if(!isset($_SESSION['customer_email'])) {
					?>
						<li><a href="../user_register.php">Sign up</a></li>
				<?php } ?>
				<li><a href="../cart.php">Shopping Cart</a></li>
				<li><a href="../contact.php">Contact Us</a></li>
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
				<div id="sidebar_title">Manage Account</div>
				<ul id="cats">
					<?php
						if(isset($_SESSION['customer_email'])) {
						$user_session = $_SESSION['customer_email'];
						$get_customer_pic = " select * from customers where customer_email='$user_session' ";
						$run_customer = mysqli_query($conn,$get_customer_pic);
						$row_customer = mysqli_fetch_array($run_customer);
						$customer_pic = $row_customer['cust_image'];


						echo " <img src='customer_image/$customer_pic' width='150' height='150'  >";
					}


					?>


					<li><a href="my_account.php?my_orders">My Orders</a></li>
					<li><a href="my_account.php?edit_account">Edit Account</a></li>
					<li><a href="my_account.php?change_pass">Change Password</a></li>
					<li><a href="my_account.php?delete_account">Delete Account</a></li>
					<li><a href="logout.php">Logout</a></li>
					
				</ul>

			</div>
			<div id="right_content">
				
				<div id="headline">
					<div id="headline_content">
						<?php 

							if(isset($_SESSION['customer_email'])) {
								
								echo "<b>Welcome "."<span style='color:skyblue'>".$_SESSION['customer_email']."</span>". "</b>";
							}
						?>
						
						&nbsp &nbsp &nbsp &nbsp 
						<?php
						if(!isset($_SESSION['customer_email'])){
							echo "<a href='../checkout.php' style='color: #f93;'>Login</a>";
						}
						else{
							echo "<a href='logout.php' style='color: #f93;'>LogOut</a>";
						}
						

						?>
						 </span>
					</div>
				</div>

				<div id="acc_msg">
					<h2 style="background: #000; color: #fc9; padding: 20px; text-align: center;border-top: 2px solid white;">Manage Your Account Here</h2>

					<?php getDefault(); 

						if (isset($_GET['my_orders'])) {
							include("my_orders.php");
						}
						if (isset($_GET['edit_account'])) {
							include("edit_account.php");
						}
					?>	
				</div>
			</div>

		<div class="footer">
			<h1 style="color: #000;padding-top: 30px;text-align: center;">&copy; 2019 - By www.tlh.com</h1>
		</div>



	</div>
	<!--main content ends-->
</body>
</html>
