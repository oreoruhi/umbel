<?php
include('connect.php');
session_start();

$branch_requestID = $_GET['id'];

	$sql = "SELECT * FROM branch_request WHERE br_ID = '$branch_requestID'";
	if($result = mysqli_query($con, $sql)){
		$row = mysqli_fetch_array($result);

		$stock_num = $row['br_stock'];
		$prod_id = $row['p_id'];

		$sql1 = "SELECT * FROM product WHERE p_ID = '$prod_id'";
		$result1 = mysqli_query($con, $sql1);
		$row1 = mysqli_fetch_array($result1);

		$product_stock = $row1['p_stock'] - $stock_num;

		$sql1_1 = "UPDATE product SET p_stock = '$product_stock' WHERE p_ID = '$prod_id'";
		mysqli_query($con, $sql1_1);

		$stock_id = $row['s_id'];

		$sql2 = "SELECT * FROM stock WHERE s_ID = '$stock_id'";
		$result2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_array($result2);

		$stock_update = $row2['s_stock'] + $stock_num;

		$sql2_1 = "UPDATE stock SET s_stock = '$stock_update' WHERE s_ID = '$stock_id'";
		mysqli_query($con, $sql2_1);

		$sql_1 = "UPDATE branch_request SET br_status = 'Approved' WHERE br_ID = '$branch_requestID'";
		mysqli_query($con, $sql_1);

		header("location: ../admin/branch_order.php?approved=true");
} else {
		header("location: ../admin/branch_order.php?fail=true");
}
?>