<?php
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
				<div id="headline">
					<div id="headline_content">
						<b>Welcome Guest!</b>
						<b style="color: yellow;">Shopping Cart: </b>
						<span>- Items: - Price:</span>
					</div>
				</div>
				<div id="product_box">
						<?php 

						if(isset($_GET['pro_id'])){
							$product_id = $_GET['pro_id'];
							$get = "select * from products where product_id = '$product_id' ";
						$run = mysqli_query($db,$get);

						while ($row=mysqli_fetch_array($run)) {
							$pro_id = $row['product_id'];
							$pro_title = $row['product_title'];
							$pro_cat = $row['cat_id'];
							$pro_brand = $row['brand_id'];
							$pro_desc = $row['product_desc'];
							$pro_price = $row['product_price'];
							$pro_image = $row['product_img1'];
							echo"

								<div id='single_product'>
									<h3> $pro_title </h3>
									<img src='adminArea/productImages/$pro_image' width='180' height = '180' /><br>
									<p><b>Price: $pro_price TK.</b></p>
									<p>$pro_desc </p><br>
									<a href ='index.php?add_cart=$pro_id' ><button style='float:right;'> Add to cart</button></a>

								</div>

							";							
						}

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
