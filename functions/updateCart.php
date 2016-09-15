<?php
include("connect.php");

$coid = $_GET['coid'];
$c_item = $_GET['id'];
$quant = $_POST['quant'];

$sql = "UPDATE cart SET c_quantity = '$quant' WHERE co_id = '$coid' AND c_itemID ='$c_item'";
mysqli_query($con, $sql);

header("location:../agent/products.php?client_id=" . $coid);

?>
