<?php
	session_start();
	include("includes/db.php");
	include("functions/functions.php");
	
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
				<li><a href="customer/my_account.php">My Account</a></li>
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
						<?php 

							if(!isset($_SESSION['customer_email'])) {
								echo "<b>Welcome Guest!</b>";
							}
							else{
								echo "<b>Welcome "."<span style='color:skyblue'>".$_SESSION['customer_email']."</span>". "</b>";
							}
						?>
						<b style="color: yellow;">Shopping Cart: </b>
						<span>- Toatal Items: <?php items();  ?> - Toatal Price: <?php total_price() ; ?> ::<a href="cart.php" style="color: #FF0;">Go To Cart</a> </span>
					</div>
				</div>

				<div align="left">
						<?php 
							if (!isset($_SESSION['customer_email'])) {
								include("customer/customer_login.php");
							}
							else{
								include("payment_options.php");
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
