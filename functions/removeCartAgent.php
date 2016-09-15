<?php
include("connect.php");

$coid = $_GET['coid'];
$c_item = $_GET['id'];


$sql = "DELETE FROM cart WHERE co_id = '$coid' AND c_itemID = '$c_item'";
mysqli_query($con, $sql);

header("location:../agent/products.php?client_id=" . $coid . "&removed=successful");

?>