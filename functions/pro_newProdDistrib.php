<?php
include('connect.php');

$id = $_GET['id'];
$stnum = $_GET['stnum'];

		
		$query2 = "SELECT * FROM branch WHERE b_status = 'Unmanaged'";
		$result = mysqli_query($con, $query2);

		if(mysqli_num_rows($result) > 0){
			foreach($result as $row){
				$sid1 = 'S' . rand(10000,50000);
				$bid2 = $row['b_ID'];

				$query3 = "INSERT INTO stock (s_ID, p_id, b_id, s_stock, s_status)
						   VALUES ('$sid1', '$id', '$bid2', '0', 'No Stock')";	
				mysqli_query($con, $query3);
			}
		}
	
		foreach($_POST['s_stock'] as $bid => $stock){
			if($stnum >= $stock){
				$sid = 'S' . rand(10000,50000);
				$stnum = $stnum - $stock;
				$sql = "UPDATE product SET p_stock = '$stnum' WHERE p_ID ='$id'";
				mysqli_query($con, $sql);
				if($stock != 0){
					$query = "INSERT INTO stock (s_ID, p_id, b_id, s_stock, s_status)
							 VALUES ('$sid', '$id', '$bid', '$stock', 'Stocked')";	
					mysqli_query($con, $query);	
				}
				else{
					$query1 = "INSERT INTO stock (s_ID, p_id, b_id, s_stock, s_status)
							  VALUES ('$sid', '$id', '$bid', '$stock', 'No Stock')";	
					mysqli_query($con, $query1);	
			}
			} else {
				header("location: ../admin/products.php?stockShort=true");
			}
		}
		header("location: checkStock.php?id=" . $id . "&stnum=" . $stnum);
?>