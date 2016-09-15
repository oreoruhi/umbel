<?php
include('connect.php');

$id = $_GET['id'];

$sql = "UPDATE product SET p_status = 'Archived' WHERE p_ID = '$id'";
	if(mysqli_query($con, $sql)){
		$sql2 = "UPDATE stock SET s_status = 'Archived' WHERE p_id = '$id'";
		if(mysqli_query($con, $sql2)){
			$sqlQuery = "SELECT * FROM bouquet_assign WHERE p_id = '$id'";
			$result = mysqli_query($con, $sqlQuery);
			$row = mysqli_fetch_assoc($result);
			$gid = $row['bo_id'];
			$sql1 = "UPDATE bouquet SET bo_status = 'Archived' WHERE bo_ID = '$gid'";
				if(mysqli_query($con, $sql1)){
					$sql3 = "UPDATE bouquet_assign SET ba_status = 'Archived' WHERE bo_id = '$gid'";
					mysqli_query($con, $sql3);
					header("location: ../admin/products.php?archived=true");
			}
		}
	}
	else{
		header("location: ../admin/products.php?fail=true");
	}

?>