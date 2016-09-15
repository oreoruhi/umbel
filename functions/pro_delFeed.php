<?php
include('connect.php');

$id = $_GET['id'];

$sql = "DELETE FROM feedback WHERE f_id = '$id'";
if(mysqli_query($con, $sql)){
	header("location: ../admin/feedback.php?deleted=true");
}
else{
	header("location: ../admin/feedback.php?fail=true");
}

?>