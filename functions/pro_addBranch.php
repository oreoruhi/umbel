<?php
include('connect.php');

if (isset($_FILES['image']['tmp_name'])) {
	$file = $_FILES['image']['tmp_name'];
	$image = file_get_contents($_FILES['image']['tmp_name']);
	$image_name = $_FILES['image']['name'];
			
			move_uploaded_file($file,"../uploads/" . $_FILES['image']['name']);
			
			$location ="uploads/" . $_FILES["image"]["name"];
}

$province = mysqli_real_escape_string($con,$_POST['province']);
$city = mysqli_real_escape_string($con,$_POST['city']);
$zip = strip_tags(mysqli_real_escape_string($con,$_POST['zip']));
$brnName = strip_tags(mysqli_real_escape_string($con,$_POST['brnName']));
$stradd = strip_tags(mysqli_real_escape_string($con,$_POST['strAdd']));
$contact = strip_tags(mysqli_real_escape_string($con,$_POST['brnContact']));
$bid = 'B' . rand(10000, 50000);


if($brnName == ""){
	header("location: ../admin/new_branch.php?empty=true");
} else {

	if($contact == ""){
		$contact = "No contact information given";
	}

	$sql = "INSERT INTO branch (b_ID, b_name, b_stradd, b_city, b_province, b_zip, b_contact, b_img, b_lat, b_long, b_status)
			VALUES ('$bid', '$brnName', '$stradd', '$city', '$province', '$zip', '$contact', '$location', '0', '0', 'Unmanaged')";

	if(mysqli_query($con, $sql)){

		$sql1="SELECT * from product WHERE p_status!='Archived'";
		$result=mysqli_query($con, $sql1);
		if($result){
			if(mysqli_num_rows($result) > 0){
				foreach($result as $row){
					$pid=$row['p_ID'];
					$sid='S' . rand(10000, 50000);
					$sql2="INSERT INTO stock (s_ID, p_id, b_id, s_stock, s_status)
						   VALUES ('$sid', '$pid', '$bid', '0', 'No Stock')";
					mysqli_query($con, $sql2);
				}
				header("location: geolocate.php?id=" . $bid);
		} else {
				header("location: geolocate.php?id=" . $bid);
		}
	}
}
	else{
		header("location: ../admin/branches.php?fail=true");
	}
}

?>