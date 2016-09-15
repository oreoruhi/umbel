<?php
include('connect.php');

$bid = $_GET['bid'];
$coid = $_POST['code'];

$sql = "UPDATE client_order SET co_status = 'Received' WHERE co_ID = '$coid'";
mysqli_query($con, $sql);

$updateStatus = "UPDATE user SET u_status = 'Active' WHERE u_position = 'Delivery Man' AND b_id = '$bid'";
mysqli_query($con, $updateStatus);

header("location:../delivery/index.php?delivered=true");

?>