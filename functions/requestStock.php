<?php
include('connect.php');
session_start();

$product_id = $_GET['id'];
$update_stock = $_POST['stockNum'];

$sql = "SELECT * FROM product WHERE p_ID = '$product_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$product_update = $row['p_stock'] + $update_stock;

$sql1 = "UPDATE product SET p_stock = '$product_update' WHERE p_ID = '$product_id'";
if(mysqli_query($con, $sql1)){
	header("location: ../admin/products.php?updated=true");
} else{
	header("location: ../admin/products.php?fail=true");
}

?>