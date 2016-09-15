<?php
include('connect.php');

if(isset($_FILES['image']['tmp_name'])) {
	$file = $_FILES['image']['tmp_name'];
	$image = file_get_contents($_FILES['image']['tmp_name']);
	$image_name = $_FILES['image']['name'];
			
			move_uploaded_file($file,"../uploads/" . $_FILES['image']['name']);
			
			$product = "uploads/" . $_FILES["image"]["name"];
}

$p_name = strip_tags(mysqli_real_escape_string($con,$_POST['p_name']));
$p_desc = strip_tags(mysqli_real_escape_string($con,$_POST['p_desc']));
$p_price = strip_tags(mysqli_real_escape_string($con,$_POST['p_price']));
$id = $_GET['id'];

$sql = "UPDATE product SET p_name ='$p_name', p_desc ='$p_desc', p_price ='$p_price' WHERE p_ID ='$id'";

if(mysqli_query($con, $sql)){
	if($product != "uploads/"){
		$sql1 = "UPDATE product SET p_img ='$product' WHERE p_ID ='$id'";
		mysqli_query($con, $sql1);
	}
	header("location: ../admin/products.php?updated=true");
}
else{
	header("location: ../admin/productUpdate.php?id=" . $id . "&fail=true");
}

?>