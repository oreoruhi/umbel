<?php
include('connect.php');
$id=$_GET['id'];
$stnum=$_GET['stnum'];

if($stnum > 0){
			header("location: ../admin/products.php?distributed=true");
}
else{
			$sql1="UPDATE product SET p_status = 'No Stock' WHERE p_ID='$id'";
			mysqli_query($con, $sql1);
			header("location: ../admin/products.php?stockShort=true");
}
?>