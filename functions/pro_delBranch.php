<?php
include('connect.php');

$id = $_GET['id'];

$sql = "DELETE FROM branch WHERE b_id = '$id'";
if(mysqli_query($con, $sql)){
	header("location: ../admin/branches.php?deleted=true");
}
else{
	header("location: ../admin/branches.php?fail=true");
}

?>