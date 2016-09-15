<?php
include("connect.php");
session_start();

$name = $_POST['clientFname'] . " " . $_POST['clientLname'];
$paymentMethod = $_POST['paymentMethod'];

if(!empty($_POST['address'])){
    $address = $_POST['address'];
} else{
    $address = "";
}


$id = $_SESSION['id'];
$get = "SELECT user.*, branch.* FROM branch LEFT JOIN user ON (user.b_id = branch.b_ID) WHERE user.u_id = '$id'";
$resultGet = mysqli_query($con, $get);
$rowGet = mysqli_fetch_assoc($resultGet);

$condition = $rowGet['b_ID'];

 $coid = 'CO' . rand(10000, 50000);
  $sqlIn = "INSERT INTO client_order (co_ID, co_name, co_payment, co_method, co_paypal, co_date, co_expire, co_address, co_status, b_id) 
  			VALUES ('$coid', '$name', '0', '$paymentMethod', null, NOW(), NOW() + INTERVAL 30 MINUTE,'$address', 'Ordered', '$condition')";
  mysqli_query($con, $sqlIn);

header("location:../agent/products.php?client_id=" . $coid . "&setClient=successful");
?>