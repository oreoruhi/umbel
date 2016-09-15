<?php
include('connect.php');

$uid ='E' . rand(10000, 50000);
$fname = strip_tags(mysqli_real_escape_string($con,$_POST['fname']));
$mname = strip_tags(mysqli_real_escape_string($con,$_POST['mname']));
$lname = strip_tags(mysqli_real_escape_string($con,$_POST['lname']));
$branch = strip_tags(mysqli_real_escape_string($con,$_POST['branch']));
$email = strip_tags(mysqli_real_escape_string($con,$_POST['email']));
$username = strip_tags(mysqli_real_escape_string($con,$_POST['uname']));
$password =strip_tags(mysqli_real_escape_string($con,$_POST['pword']));
$position ='Branch Manager';


if($fname == "" && $lname == "" && $uname == ""){
	header("location: ../admin/new_manager.php?empty=true");
}
else{
		$sqli = "SELECT * FROM user WHERE u_uname ='$username'";
		$check = mysqli_query($con, $sqli);

		if(mysqli_num_rows($check) > 0){
			header("location: ../admin/new_manager.php?unameTaken=true");
		} else{
			$sql = "INSERT INTO user (u_id, u_fname, u_mname, u_lname, u_position, b_id, u_email, u_uname, u_password, u_status)
					VALUES ('$uid', '$fname', '$mname', '$lname', '$position', '$branch', '$email', '$username', '$password', 'Inactive')";

			if(mysqli_query($con, $sql)){
	
				$sql2= "UPDATE branch SET b_status='Managed' where b_ID='$branch'";
				if(mysqli_query($con, $sql2)){
					header("location: ../admin/employees.php?added=true");
				}
			}	else{
					header("location: ../admin/employees.php?fail=true");
		}
	}
}

?>