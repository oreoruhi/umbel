<?php

include('connect.php');

$id=$_GET['id'];
$pword = strip_tags(mysqli_real_escape_string($con,$_POST['pword']));



	$sqlQuery = "UPDATE user SET u_password = '$pword' WHERE u_uname = '$id'";
	if(mysqli_query($con, $sqlQuery)){
		header("location:../index.php?passChange=true");
	} else{
		header("location:../index.php?fail=true");
	}

?>