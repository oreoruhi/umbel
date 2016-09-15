<?php
include('connect.php');

$fid = "F" . rand(10000,50000);
$name = strip_tags(mysqli_real_escape_string($con, $_POST['clientName']));
$email = strip_tags(mysqli_real_escape_string($con,$_POST['clientEmail']));
$type = strip_tags(mysqli_real_escape_string($con,$_POST['feedbackType']));
$message = strip_tags(mysqli_real_escape_string($con,$_POST['clientMessage']));
$subject = strip_tags(mysqli_real_escape_string($con,$_POST['clientSubject']));

$sql = "INSERT INTO feedback (f_ID, f_name, f_email, f_type, f_subject, f_message, f_time)
		VALUES ('$fid', '$name', '$email', '$type', '$subject', '$message', NOW())";

if(mysqli_query($con, $sql)){
	header("location: ../faq.php#cont?sent=true");
}
else{
	echo "something is wrong";
}
?>