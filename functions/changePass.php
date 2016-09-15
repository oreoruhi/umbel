<?php
session_start();
include('connect.php');

$id=$_GET['id'];
$pword = strip_tags(mysqli_real_escape_string($con,$_POST['pword']));
$oldPass = strip_tags(mysqli_real_escape_string($con,$_POST['oldPass']));
$secQuest = strip_tags(mysqli_real_escape_string($con,$_POST['secQuest']));
$secAns = strip_tags(mysqli_real_escape_string($con,$_POST['secAns']));

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

$sql="SELECT * FROM user WHERE u_id='$id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);

if($oldPass == $row['u_password']){
	$sqlQuery = "UPDATE user SET u_password = '$pword' WHERE u_id = '$id'";
	mysqli_query($con, $sqlQuery);
	if($row['u_status'] == 'Inactive'){
		$sqlQuery1 = "UPDATE user SET u_status = 'Active' WHERE u_id='$id'";
		if(mysqli_query($con, $sqlQuery1)){

			$sid='S' . rand(10000, 50000);
			$query="INSERT INTO security (sec_ID, u_ID, sec_question, sec_answer)
					VALUES ('$sid', '$id', '$secQuest', '$secAns')";
			mysqli_query($con, $query);

			header("location: ../" . $direct . "/index.php?passWelcome=true");
	}
	} else {
		header("location: ../" . $direct . "/index.php?passUpdate=true");
	}
} else {
	if($row['u_status'] == 'Inactive'){
		header("location: ../" . $direct . "/firstTime.php?fail=true");
	} else {
		header("location: ../" . $direct . "/index.php?invalid=true");
	}
}
?>