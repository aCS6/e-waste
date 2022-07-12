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
						<span>- Toatal Items: <?php items();  ?> - Toatal Price: <?php total_price() ; ?> ::<a href="index.php" style="color: #FF0;">Back to shopping</a>
							&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
						<?php
						if(!isset($_SESSION['customer_email'])){
							echo "<a href='checkout.php' style='color: #f93;'>Login</a>";
						}
						else{
							echo "<a href='logout.php' style='color: #f93;'>LogOut</a>";
						}
						?>
						</span>

					</div>
				</div>

				<div id="product_box">
					<form action="cart.php" method="post" enctype="multipart/form-data">
						<table width="700" align="center" bgcolor="#0099cc">
							<tr align="center">
								<td><b>Remove</b></td>
								<td><b>Product (s)</b></td>

								<td><b>Total Price</b></td>
							</tr>
							<?php 
								$ip_add = getRealIpAddr();
								$total =0;

								$sel_price = "select * from cart where ip_add = '$ip_add' ";
								$run_price = mysqli_query($db,$sel_price);
								while($record=mysqli_fetch_array($run_price)){
									$pro_id = $record['p_id'];
									$pro_price = "select * from products where product_id='$pro_id'";

									$run_pro_price = mysqli_query($db,$pro_price );
									while ($p_price=mysqli_fetch_array($run_pro_price)) {
										$product_price = array($p_price['product_price']);
										$product_title = $p_price['product_title'];
										$product_image = $p_price['product_img1'];
										$only_price = $p_price['product_price'];
										$value = array_sum($product_price);
										$total = $total + $value;
							?>
							<tr>
								<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;  ?>"></td>
								<td><?php echo $product_title; ?><br><img src="adminArea/productImages/<?php echo $product_image; ?>" height="80" width="80" > </td>
								
								<td><?php echo $only_price." TK"; ?></td>
							</tr>
						<?php }} ?> 
						<tr >
							<td colspan="2" align="right"><b>Sub Total :</b></td>
							<td><b><?php echo $total." TK"; ?></b></td>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						
						<tr>
							<td><input type="submit" name="update" value="Update Cart"></td>
							<td><input type="submit" name="continue" value="Continnue Shopping"></td>
							<td><button><a href="checkout.php" style="text-decoration: none;color: #000;">Checkout</a></button></td>
						</tr>
							
						</table>


					</form>
					<?php
					function updatecart(){
						global $conn; 
						if (isset($_POST['update'])) {
							foreach ($_POST['remove'] as $remove_id) {
								$delete_products = "delete from cart where p_id='$remove_id' ";
								$run_delete = mysqli_query($conn,$delete_products );
								if($run_delete){
									echo "<script> window.open('cart.php','_self')</script>";
								}
							}
						}
						if(isset($_POST['continue'])){
							echo "<script> window.open('index.php','_self')</script>";
						}
					}
					echo @$up_cart = updatecart();
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

