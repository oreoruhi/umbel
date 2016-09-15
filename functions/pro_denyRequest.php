<?php
include('connect.php');
session_start();

$branch_requestID = $_GET['id'];

$sql = "UPDATE branch_request SET br_status = 'Denied' WHERE br_ID = '$branch_requestID'";
if(mysqli_query($con, $sql)){
	header("location: ../admin/branch_order.php?denied=true");
} else{
	header("location: ../admin/branch_order.php?fail=true");
}

?>