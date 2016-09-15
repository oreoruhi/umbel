<?php
include('connect.php');

$id = $_GET['id'];

$sql = "UPDATE bouquet SET bo_status = 'Archived' WHERE bo_ID = '$id'";
	if(mysqli_query($con, $sql)){
		$sql2 = "UPDATE bouquet_assign SET ba_status = 'Archived' WHERE bo_id = '$id'";
		if(mysqli_query($con, $sql2)){
				header("location: ../admin/bouquets.php?archived=true");
			}
		}
	else{
		header("location: ../admin/products.php?fail=true");
	}

?>