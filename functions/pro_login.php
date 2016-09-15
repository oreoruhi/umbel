<?php
include 'connect.php';
session_start();

if(isset($_POST['login'])){
$user = mysqli_real_escape_string($con,$_POST['user']);
$pass = mysqli_real_escape_string($con,$_POST['pass']);

$query = "select * from user where u_uname = '$user' and u_password = '$pass'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

    if($row['u_position'] == 'Administrator'){
       $_SESSION['user'] = $user; 
       $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Administrator';
       header("location: ../admin/index.php"); 
    }else if ($row['u_position'] == 'Branch Manager'){
       if($row['u_status'] == 'Inactive'){
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Branch Manager';
       header("location: ../manager/firstTime.php"); 
       } else{
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Branch Manager';
       header("location: ../manager/index.php"); 
       }
	}	
	else if ($row['u_position'] == 'Agent'){
       if($row['u_status'] == 'Inactive'){
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Agent';
       header("location: ../agent/firstTime.php"); 
       } else{
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Agent';
       header("location: ../agent/index.php"); 
       }
	} 
	else if ($row['u_position'] == 'Delivery Man'){
       if($row['u_status'] == 'Inactive'){
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Delivery Man';
       header("location: ../delivery/firstTime.php"); 
       } else{
	   $_SESSION['user'] = $user; 
	   $_SESSION['id'] = $row['u_id']; 
	   $_SESSION['type'] = 'Delivery Man';
       header("location: ../delivery/index.php"); 
       }
	}		
	else if(empty($user)){
       header("location: ../index.php?empty=true");
    }else{
	   header ("location:../index.php?invalid=true");
	}

} else {
	header("location: ../forgotPass.php");
}
?>