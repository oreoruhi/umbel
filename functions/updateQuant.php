<?php
session_start();
include('connect.php');
if(isset($_POST['update'])){
	$data = count($_POST['qty']);
	for ($i = 0; $i < $data ; $i++) { 
		$_SESSION['cart_qty'][$i] = $_POST['qty'][$i];
	}

	header("location:../cart.php");
}
else{

	if($_SESSION['grandTotal'] == 0){
		header("location:../cart.php");
	}else{
		header("location:../checkout.php");
	}

}


?>
