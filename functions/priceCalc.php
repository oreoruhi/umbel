<?php
include('connect.php');
$id = $_GET['id'];
$name = $_GET['name'];

$sql1 = "SELECT product.*, bouquet_assign.* 
		FROM bouquet_assign 
		LEFT JOIN product 
		ON (bouquet_assign.p_id = product.p_ID) 
		WHERE ba_status ='Available' 
		AND ba_name ='$name'";
$result = mysqli_query($con, $sql1);

$price = 0;

while($row = mysqli_fetch_array($result)){

	$price = ($row['ba_num'] * $row['p_price']) + $price;
}

if($price > 0){
	$sql = "UPDATE bouquet SET bo_price='$price', bo_status='Available' WHERE bo_ID='$id'";
	mysqli_query($con, $sql);
	header("location: ../admin/bouquets.php?added=true");
}
else {
	$del = "DELETE FROM bouquet WHERE bo_ID='$id'";
	mysqli_query($con, $sql);
	header("location: ../admin/bouquets.php?fail=true");
}

?>