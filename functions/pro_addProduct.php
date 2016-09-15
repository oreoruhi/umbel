<?php
include('connect.php');

if (isset($_FILES['image']['tmp_name'])) {
	$file = $_FILES['image']['tmp_name'];
	$image = file_get_contents($_FILES['image']['tmp_name']);
	$image_name = $_FILES['image']['name'];
			
			move_uploaded_file($file,"../uploads/" . $_FILES['image']['name']);
			
			$product ="uploads/" . $_FILES["image"]["name"];
}

$p_name = strip_tags(mysqli_real_escape_string($con,$_POST['p_name']));
$p_desc = strip_tags(mysqli_real_escape_string($con,$_POST['p_desc']));
$p_stock = strip_tags(mysqli_real_escape_string($con,$_POST['p_stock']));
$p_price = strip_tags(mysqli_real_escape_string($con,$_POST['p_price']));
$p_id = 'P' . rand(10000, 50000);

if($p_name == ""){
	header("location: ../admin/new_product.php?empty=true");
}else {

$sql = "INSERT INTO product (p_ID, p_name, p_desc, p_img, p_price, p_stock, p_status)
		VALUES ('$p_id', '$p_name', '$p_desc', '$product', '$p_price', '$p_stock', 'Stocked')";

if(mysqli_query($con, $sql)){
	header("location: ../admin/newProdDistrib.php?id=" . $p_id . "&stnum=" . $p_stock);
}
else{
	header("location: ../admin/products.php?fail=true");
}
}

?>