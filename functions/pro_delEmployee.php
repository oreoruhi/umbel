<?php
include('connect.php');

$id = $_GET['id'];
$bid = $_GET['bid'];

$query = "SELECT * FROM user WHERE u_id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);


if($row['u_position'] == 'Branch Manager'){
	$sql = "DELETE FROM user WHERE u_id = '$id'";
	if(mysqli_query($con, $sql)){
		$sql2 = "UPDATE branch SET b_status = 'Unmanaged' WHERE b_ID = '$bid'";
		if(mysqli_query($con, $sql2)){
			header("location: ../admin/employees.php?deletedA=true");
		}
	}
		else{
			header("location: ../admin/employees.php?fail=true");
		}
	}
else{
	$sql3 = "DELETE FROM user WHERE u_id = '$id'";
	if(mysqli_query($con, $sql3)){
		header("location: ../manager/employees.php?deletedB=true");
	}
	else{
		header("location: ../manager/employees.php?fail=true");
	}
}
?>