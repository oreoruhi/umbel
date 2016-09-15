<?php
include('connect.php');
session_start();


$id = $_SESSION['id'];

$sqlit = "SELECT * FROM user WHERE u_id ='$id'";
$checkRelt = mysqli_query($con, $sqlit);
$row = mysqli_fetch_assoc($checkRelt);

$uid = 'E' . rand(10000, 50000);
$fname = strip_tags(mysqli_real_escape_string($con,$_POST['fname']));
$mname = strip_tags(mysqli_real_escape_string($con,$_POST['mname']));
$lname = strip_tags(mysqli_real_escape_string($con,$_POST['lname']));
$branch = $row['b_id'];
$email = strip_tags(mysqli_real_escape_string($con,$_POST['email']));
$username = strip_tags(mysqli_real_escape_string($con,$_POST['uname']));
$password =strip_tags(mysqli_real_escape_string($con,$_POST['pword']));
$position =strip_tags(mysqli_real_escape_string($con,$_POST['position']));

if($fname == "" && $lname == "" && $uname == ""){
	header("location: ../manager/new_employee.php?empty=true");
}
else{
		$sqli="SELECT * FROM user WHERE u_uname ='$username'";
		$check=mysqli_query($con, $sqli);

		if(mysqli_num_rows($check) > 0){
			header("location: ../manager/new_employee.php?unameTaken=true");
		} else{
			$sql = "INSERT INTO user (u_id, u_fname, u_mname, u_lname, u_position, b_id, u_email, u_uname, u_password, u_status)
					VALUES ('$uid', '$fname', '$mname', '$lname', '$position', '$branch', '$email', '$username', '$password', 'Inactive')";

			if(mysqli_query($con, $sql)){
				header("location: ../manager/employees.php?added=true");
		}	else{
				header("location: ../manager/employees.php?fail=true");
			}
		}
}
?>