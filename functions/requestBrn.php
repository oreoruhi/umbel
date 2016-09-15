<?php
include('connect.php');
session_start();

$branch_requestID = 'BR' . rand(10000,50000);
$branch_id = $_GET['branch'];
$stock_id = $_GET['stockid'];
$product_id = $_GET['id'];
$number = $_POST['stockNum'];

$sql = "INSERT INTO branch_request (br_ID, b_id, s_id, p_id, br_stock, br_status)
		VALUES ('$branch_requestID', '$branch_id', '$stock_id', '$product_id', '$number', 'Pending')";

if(mysqli_query($con, $sql)){
	header("location:../manager/products.php?request=true");
} else {
	header("location../manager/products.php?request=true");
}



?>