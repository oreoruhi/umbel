<?php
include("connect.php");
session_start();

$id=$_SESSION['id'];

$get="SELECT user.*, branch.* FROM branch LEFT JOIN user ON (user.b_id = branch.b_ID) WHERE user.u_id = '$id'";
$resultGet=mysqli_query($con, $get);
$rowGet=mysqli_fetch_assoc($resultGet);
$condition=$rowGet['b_ID'];

$prodID = $_GET['id'];
$coid= $_GET['coid'];

$quant = $_POST['quant'];

$sql = "SELECT stock.*, branch.*, product.*
		FROM stock
		LEFT JOIN branch
		ON (stock.b_id = branch.b_ID)
		LEFT JOIN product
		ON (stock.p_id = product.p_ID)
		WHERE stock.b_id = '$condition'
		AND product.p_id = '$prodID'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


$cid = "C" . rand(10000, 50000);
$cname = $row['p_name'];
$cprice = $row['p_price'];

$sql3= "INSERT INTO cart (c_ID, c_itemID, c_name, c_price, c_quantity, c_status, co_id)
		VALUES('$cid', '$prodID', '$cname', '$cprice', '$quant', 'In Cart', '$coid')";
mysqli_query($con, $sql3);


header("location:../agent/products.php?client_id=" . $coid . "&added=successful");

?>