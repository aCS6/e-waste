<?php
	include("includes/db.php");

	$c = $_SESSION['customer_email'];
	$gey_c = " select * from customers where customer_email='$c' ";
	$run_c = mysqli_query($db,$gey_c);

	$row_c=mysqli_fetch_array($run_c);

	$customer_id = $row_c['customer_id'];


?>
<br>
<h3 align="center">All Order Details</h3>
<table width="800" align="center" bgcolor="#6699ff" frame="box">

	<tr align="center">
		<th>Order no</th>
		<th>Due Amount</th>
		<th>Invoice No</th>
		<th>Order date</th>
		<th>Paid/Unpaid</th>
		<th>Status</th>

	
		<?php

			$get_orders = " select * from customer_orders where customer_id='$customer_id' ";
			$run_orders = mysqli_query($conn,$get_orders);
			$i=1;

			while($row=mysqli_fetch_array($run_orders)){
				
				$o_id = $row['order_id'];
				$p1 = $row['due_amount'];
				$p2 = $row['invoice_no'];
				$p4 = $row['order_date'];
				$p5 = $row['order_status'];

				if($p5=='Pending'){
					$p5='Unpaid';
				}
				else{
					$p5='Paid';
				}
				echo"
				<tr align='center'>
					<td>$i</td>
					<td>$p1</td>
					<td>$p2</td>
					<td>$p4</td>
					<td>$p5</td>
					<td> <a href='confirm.php?order_id=$o_id' target='_blank'> Confirm if paid </a> </td>
				</tr>

				";
				$i++;
			}

		?>
	</tr>
</table>