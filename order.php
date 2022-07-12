<?php
	include("includes/db.php");
	include("functions/functions.php");
	//Getting customer ID
	if(isset($_GET['c_id'])){
		$customer_id = $_GET['c_id'];

	}
	// getting products price & number of items

	$ip_add = getRealIpAddr();
								$total =0;

								$sel_price = "select * from cart where ip_add = '$ip_add' ";
								$run_price = mysqli_query($conn,$sel_price);

								$status = 'Pending';
								$invoice_no = mt_rand();
								$count_pro = mysqli_num_rows($run_price);

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
									}
								}

								$insert_order = " INSERT INTO `customer_orders`(`customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES ('$customer_id','$total','$invoice_no','$count_pro',NOW(),'$status') ";

								$run_order = mysqli_query($conn,$insert_order);

								if($run_order){
									echo " <script> alert('Order successfully submitted, Thanks! ') </script>  ";
									echo "<script> window.open('customer/my_account.php','_self')</script>";

									

									$insert_into_pending_orders = " INSERT INTO `pending_orders`(`customer_id`, `invoice_no`, `product_id`, `order_status`) VALUES ('$customer_id','$invoice_no','$pro_id','$status') ";

									$run_pending_order = mysqli_query($conn,$insert_into_pending_orders);

									$empty_cart = "delete from cart where ip_add='$ip_add' ";
									$run_empty = mysqli_query($conn,$empty_cart);
								}



	
?>