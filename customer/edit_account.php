<?php

	@session_start();

	include("includes/db.php");

	if (isset($_GET['edit_account'])) {
		
		$customer_email = $_SESSION['customer_email'];
		$get_customer = " select * from customers where customer_email= '$customer_email' ";
		$run_customer = mysqli_query($conn,$get_customer);
		$row = mysqli_fetch_array($run_customer);

		$id = $row['customer_id'];
		$name = $row['customer_name'];
		$email = $row['customer_email'];
		$country = $row['customer_country'];
		$city = $row['customer_city'];
		$contact = $row['customer_contact'];
		$address = $row['customer_address'];
		$image = $row['cust_image'];

	}
	
?>

<form action="" method="post" enctype="multipart/form-data">
	<table align="center" width="600">
		<table>
								<tr>
									<td colspan="8" align="center"><h2>Update Your Account</h2></td>
								</tr>
								<tr>
									<td><b>Customer Name:</b></td>
									<td><input type="text" name="c_name" value="<?php echo $name; ?>"></td>
								</tr>
								<tr>
									<td><b>Customer Email:</b></td>
									<td><input type="text" name="c_email" value="<?php echo $email; ?>"></td>
								</tr>
								<tr>
									<td><b>Customer Country:</b></td>
									<td>
										<select name="c_country" disabled>
											<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
											<option value="Bangladesh">Bangladesh</option>
											<option value="India">India</option>
											<option value="Maldeves">Maldeves</option>
											<option value="Sri Lanka">Sri Lanka</option>
											
										</select>
									</td>
								</tr>
								<tr>
									<td><b>Customer City:</b></td>
									<td><input type="text" name="c_city" value="<?php echo $city; ?>"></td>
								</tr>
								<tr>
									<td><b>Customer Mobile:</b></td>
									<td><input type="text" name="c_contact" value="<?php echo $contact; ?>"></td>
								</tr>
								<tr>
									<td><b>Customer Address:</b></td>
									<td><input type="text" name="c_address" value="<?php echo $address; ?>"></td>
								</tr>
								<tr>
									<td><b>Customer Image:</b></td>
									<td><input type="file" name="c_image" size="60"><img src="customer_image/<?php echo $image; ?>" width="60" height = "60"></td>
								</tr>
								<tr>
									<td colspan="8" align="center">
										<input type="submit" name="update" value="Update Now">
									</td>
								</tr>
	</table>
	
</form>

<?php

	if(isset($_POST['update'])){
		$Uid = $id;
		$u1 = $_POST['c_name'];
		$u2 = $_POST['c_email'];
		$u3 = $_POST['c_city'];
		$u4 = $_POST['c_contact'];
		$u5 = $_POST['c_address'];

		$u6 = $_FILES['c_image']['name'];
		$u7 = $_FILES['c_image']['tmp_name'];

		move_uploaded_file($u7, "customer_image/$u6");

		$q = " UPDATE `customers` SET `customer_name`='$u1',`customer_email`='$u2',`customer_city`='$u3',`customer_contact`='$u4',`customer_address`='$u5' ,`cust_image`='$u6' WHERE customer_id = '$Uid' ";


		$run = mysqli_query($conn,$q);

		if($run){
			echo " <script> alert('Your account Has been Updated!') </script> ";
			echo " <script> window.open('my_account.php','_self') </script> "; 
			
		}
		else{
			echo mysqli_error($conn);
		}


	}

?>
