<?php
include('connect.php');

$id = $_GET['id'];
$name = $_GET['name'];

foreach($_POST['b_num'] as $pid => $num){
	if($num > 0){
		$baid = "BA" . rand(10000, 50000);
		$sql ="INSERT INTO bouquet_assign (ba_ID, bo_id, p_id, ba_name, ba_num, ba_status) 
			   VALUES ('$baid', '$id', '$pid', '$name', '$num', 'Available')";
		mysqli_query($con, $sql);
	} 	
}
header("location: priceCalc.php?id=" . $id . "&name=" . $name);
?>