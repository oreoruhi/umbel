<?php
include('connect.php');

if(isset($_FILES['image']['tmp_name'])) {
	$file = $_FILES['image']['tmp_name'];
	$image = file_get_contents($_FILES['image']['tmp_name']);
	$image_name = $_FILES['image']['name'];
			
			move_uploaded_file($file,"../uploads/" . $_FILES['image']['name']);
			
			$location = "uploads/" . $_FILES["image"]["name"];
}

$id = $_GET['id'];
$brnName = strip_tags(mysqli_real_escape_string($con,$_POST['brnName']));
$stradd = strip_tags(mysqli_real_escape_string($con,$_POST['strAdd']));
$contact = strip_tags(mysqli_real_escape_string($con,$_POST['brnContact']));

if($contact == ""){
	$contact = "No contact information given";
}

$sql = "UPDATE branch SET b_name='$brnName', b_stradd='$stradd', b_contact='$contact' WHERE b_ID='$id'";

if(mysqli_query($con, $sql)){
	if($location != "uploads/"){
		$sql1 = "UPDATE branch SET b_img='$location' WHERE b_id='$id'";
		mysqli_query($con, $sql1); 
	}
	header("location: geolocateEdit.php?id=" . $id);
}
else{
	header("location: ../admin/editBranch.php?id=" . $id . "&fail=true");
}

?>