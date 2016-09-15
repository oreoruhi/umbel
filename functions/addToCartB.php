<?php
include("connect.php");

$boID = $_GET['id'];
$coid= $_GET['coid'];

$quant = $_POST['quant'];

$sql = "SELECT * FROM bouquet WHERE bo_ID = '$boID'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


$cid = "C" . rand(10000, 50000);
$cname = $row['bo_name'];
$cprice = $row['bo_price'];


$sql3= "INSERT INTO cart (c_ID, c_itemID, c_name, c_price, c_quantity, c_status, co_id)
		VALUES('$cid', '$boID', '$cname', '$cprice', '$quant', 'In Cart', '$coid')";
mysqli_query($con, $sql3);


header("location:../agent/products.php?client_id=" . $coid . "&added=successful");

?>