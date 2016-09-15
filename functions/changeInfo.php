<?php
session_start();
include('connect.php');
$id=$_GET['id'];
$user=$_GET['user'];

$fname = strip_tags(mysqli_real_escape_string($con,$_POST['fname']));
$mname = strip_tags(mysqli_real_escape_string($con,$_POST['mname']));
$lname = strip_tags(mysqli_real_escape_string($con,$_POST['lname']));
$username = strip_tags(mysqli_real_escape_string($con,$_POST['uname']));

$row = $_SESSION['type'];

if($row == 'Administrator'){
	$direct = 'admin';
} else if($row == 'Branch Manager'){
	$direct = 'manager';
} else if($row == 'Agent'){
	$direct = 'agent';
} else {
	$direct = 'delivery';
}


$sqlQuery="UPDATE user SET u_fname='$fname', u_mname='$mname', u_lname='$lname' WHERE u_id='$id'";
mysqli_query($con, $sqlQuery);


$sql="SELECT * FROM user WHERE u_uname = '$username'";
$result=mysqli_query($con, $sql);


if($username != "" && $username!= $user){

	if(mysqli_num_rows($result) > 0){
		header("location: ../" . $direct . "/index.php?taken=true");
	}
	else{
		$sqlUser="UPDATE user SET u_uname='$username' WHERE u_id='$id'";
		mysqli_query($con, $sqlUser);
		header("location: ../" . $direct . "/index.php?userUpdate=true");
	}

} else {
	header("location: ../" . $direct . "/index.php?userUpdate=true");
}

?>