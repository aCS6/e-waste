<?php
	include("includes/db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
	<script>
  tinymce.init({
    selector: 'textarea'
  });
  </script>
</head>
<body bgcolor="#99999">
<form method="post" action="insert_product.php" enctype="multipart/form-data">
	<table width="700" align="center" border="1" bgcolor="#3399cc">
		<tr>
			<td colspan="2" align="center"><h2>Insert New Product:</h2></td>
		</tr>
		<tr>
			<td><b>Product Title</b></td>
			<td>
				<input type="text" name="product_title" required size="50">
			</td>
		</tr>
		<tr>
			<td><b>Product Catagory</b></td> 
			<td>
				
				<select name="product_cat" required >
				<option value="">Select a Catagory</option>

				<?php

						$sql  = "SELECT * FROM `catagories`";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];
								echo "<option value='$cat_id' > $cat_title </option> ";
							}
						} 

					?>
					</select>
			</td>
		</tr>
		<tr>
			<td><b>Product Brand</b></td>
			<td>
				
				<select name="product_brand" required >
					<option value="">Select Brand</option>
					<?php

						$sql  = "SELECT * FROM `brands`";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$brand_id = $row['brand_id'];
								$brand_title = $row['brand_title'];
								echo "<option value='$brand_id' > $brand_title </option> ";
							}
						}
						?>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Parts Type</b></td>
			<td>
				<select name="parts_type" required >
					<option value="" >Select Parts Type</option>
					<?php

						$sql  = "SELECT * FROM `parts`";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$parts_id = $row['parts_id'];
								$parts_title = $row['parts_title'];
								echo "<option value='$parts_id' > $parts_title </option> ";
							}
						}
						?>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Product Image 1</b></td>
			<td>
				<input type="file" name="uploadfile1" required />
			</td>
		</tr>
		<tr>
			<td><b>Product Price</b></td>
			<td>
				<input type="text" name="product_price" required size="50">
			</td>
		</tr>
		<tr>
			<td><b>Product Description</b></td>
			<td>
				<textarea name="product_desc" cols="60" rows="10" style="resize: none;"></textarea>
			</td>
		</tr>
		<tr>
			<td><b>Product Keyword</b></td>
			<td>
				<input type="text" name="product_keyword" required size="50">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="insert_product" value="Insert Product">
			</td>
		</tr>
	</table>
</form>
</body>
</html>


<?php

	if(isset($_POST['insert_product'])){
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$parts = $_POST['parts_type'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keyword = $_POST['product_keyword'];
		$status='on';

		// image uploading
		 $filename1 = $_FILES['uploadfile1']['name'];
		 $filetmpname1 = $_FILES['uploadfile1']['tmp_name'];
		 $folder1 = 'productImages/';
		 move_uploaded_file($filetmpname1, $folder1.$filename1);

		 
		

		$insert_product = " INSERT INTO `products`( `cat_id`, `brand_id`, `parts_id`, `date`, `product_title`, `product_img1`, `product_price`, `product_desc`, `status`,`keyword`) VALUES ('$product_cat','$product_brand','$parts',NOW(),'$product_title','$filename1','$product_price','$product_desc','$status','$product_keyword')";

		$run_product = mysqli_query($conn,$insert_product);
		if ($run_product) {
			echo "<script> alert('Product Inserted Successfully')</script>";
		}
		
	}


?>