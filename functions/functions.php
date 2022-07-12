<?php
	
	$db = mysqli_connect("localhost","root","","ewaste");

	// functions for getting real IP address
	function getRealIpAddr(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			// check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}


	// Creating the script for cart
	function cart(){
		global $db;
		if(isset($_GET['add_cart'])){
			$ip_add = getRealIpAddr();
			$p_id = $_GET['add_cart'];


			$q = "SELECT * FROM `cart` where ip_add='$ip_add' AND p_id='$p_id'";


			$run = mysqli_query($db,$q);

			if(mysqli_num_rows($run)>0){
				echo "";
			}
			else{
				$q = "insert into cart(p_id,ip_add) values ('$p_id','$ip_add')";
				$run = mysqli_query($db,$q);
				echo " <script>window.open('index.php','_self') </script>  ";
			}
		}
	}

	// getting the number of items from the cart

	function items(){
		global $db;
		$ip_add = getRealIpAddr();
		if(isset($_GET['add_cart'])){
			$get_items= " select * from cart where ip_add='$ip_add' ";
			$run = mysqli_query($db,$get_items);
			$count = mysqli_num_rows($run);
		}
		else{
			$get_items= " select * from cart where ip_add='$ip_add' ";
			$run = mysqli_query($db,$get_items);
			$count = mysqli_num_rows($run);
		}
		echo $count;
	}


	// getting the total price from cart

	function total_price(){
		global $db;
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
				$value = array_sum($product_price);
				$total = $total + $value;
			}
		}
		echo $total." Tk.";

	}

	function getPro(){
		global $db;
		if(!isset($_GET['cat'])){
			if(!isset($_GET['brand'])){
						$get = "select * from products order by rand() LIMIT 0,6";
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
									<a href ='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
									<a href ='index.php?add_cart=$pro_id'><button style='float:right;'> Add to cart</button></a>

								</div>

							";							
						}
			}
		}					
	}
	function getAllPro(){
		global $db;
		if(!isset($_GET['cat'])){
			if(!isset($_GET['brand'])){
						$get = "select * from products ";
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
									<a href ='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
									<a href ='index.php?add_cart=$pro_id'><button style='float:right;'> Add to cart</button></a>

								</div>

							";							
						}
			}
		}					
	}


	function getCatPro(){
		global $db;
		if(isset($_GET['cat'])){

						$cat_id = $_GET['cat'];

						$get_cat_pro = "select * from products where cat_id='$cat_id'";
						$run = mysqli_query($db,$get_cat_pro);

						$count = mysqli_num_rows($run);
						if($count==0){
							echo "<h2> NO products found in this catagory! </h2>";
						}

						
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
									<a href ='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
									<a href ='index.php?add_cart=$pro_id'><button style='float:right;'> Add to cart</button></a>

								</div>

							";							
						}
			
		}					
	}
	function getBrandPro(){
		global $db;
		if(isset($_GET['brand'])){

						$brand_id = $_GET['brand'];

						$get_brand_pro = "select * from products where brand_id='$brand_id'";
						$run = mysqli_query($db,$get_brand_pro);

						$count = mysqli_num_rows($run);
						if($count==0){
							echo "<h2> NO products found in this catagory! </h2>";
						}

						
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
									<a href ='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
									<a href ='index.php?add_cart=$pro_id'><button style='float:right;'> Add to cart</button></a>

								</div>

							";							
						}
			
		}					
	}



	function getBrands(){
		global $db;
		$sql  = "SELECT * FROM `brands`";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$brand_id = $row['brand_id'];
				$brand_title = $row['brand_title'];
				echo " <li><a href='index.php?brand=$brand_id'>$brand_title</a></li> " ;
			}
		}
	}

	function getCat(){
		global $db;

						$sql  = "SELECT * FROM `catagories`";
						$result = $db->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];
								echo " <li><a href='index.php?cat=$cat_id'>$cat_title</a></li> " ;
							}
						} 
	}












?>