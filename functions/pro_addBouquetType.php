<?php
include('connect.php');

if (isset($_FILES['image']['tmp_name'])) {
	$file = $_FILES['image']['tmp_name'];
	$image = file_get_contents($_FILES['image']['tmp_name']);
	$image_name = $_FILES['image']['name'];
			
			move_uploaded_file($file,"../uploads/" . $_FILES['image']['name']);
			
			$product = "uploads/" . $_FILES["image"]["name"];
}

$bo_name = strip_tags(mysqli_real_escape_string($con,$_POST['bo_name']));
$bo_desc = strip_tags(mysqli_real_escape_string($con,$_POST['bo_desc']));
$b_id = 'BO' . rand(10000, 50000);

if($bo_name != ""){
	$sql = "INSERT INTO bouquet (bo_ID, bo_name, bo_desc, bo_price, bo_img, bo_status)
			VALUES ('$b_id', '$bo_name', '$bo_desc', '0', '$product', 'Not Available')";

	if(mysqli_query($con, $sql)){
		header("location: ../admin/newBouquetType.php?id=" . $b_id);
	}
	else{
		header("location: ../admin/bouquets.php?fail=true");
	}
}
else{
	header("location: ../admin/new_bouquetType.php?empty=true");
}

?>