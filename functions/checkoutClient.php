<?php
include("connect.php");
session_start();

$coid=$_GET['coid'];
$total=0;

$id=$_SESSION['id'];
$get="SELECT user.*, branch.* FROM branch LEFT JOIN user ON (user.b_id = branch.b_ID) WHERE user.u_id = '$id'";
$resultGet=mysqli_query($con, $get);
$rowGet=mysqli_fetch_assoc($resultGet);
$condition=$rowGet['b_ID'];

$sql = "SELECT cart.*, client_order.*
		FROM cart
		LEFT JOIN client_order
		ON (client_order.co_ID = cart.co_id)
		WHERE cart.co_id='$coid'";
$result = mysqli_query($con, $sql);

	while($row = mysqli_fetch_array($result)){

		$pid = $row['c_itemID'];

		$query = "SELECT product.*, branch.*, stock.* 
				  FROM stock
				  LEFT JOIN product
				  ON (product.p_ID = stock.p_id)
				  LEFT JOIN branch
				  ON (branch.b_ID = stock.b_id)
				  WHERE stock.p_id = '$pid'
				  AND stock.b_id = '$condition'";
		$resultQuery=mysqli_query($con, $query);
		$rowQuery=mysqli_fetch_assoc($resultQuery);

		$stock = $rowQuery['s_stock'];

		$stock = $rowQuery['s_stock'] - $row['c_quantity'];

		$queryAgain = "UPDATE stock SET s_stock = '$stock' WHERE p_id = '$pid' AND b_id = '$condition'";
		mysqli_query($con, $queryAgain);


		$add = $row['c_price'] * $row['c_quantity'];
		$total = $add + $total;
	}

$querylast="SELECT * FROM client_order WHERE co_ID = '$coid'";
$resultLast = mysqli_query($con, $querylast);
$row1 = mysqli_fetch_assoc($resultLast);

if($row1['co_method'] == "Walk In"){
	$lastQuery = "UPDATE client_order SET co_payment = '$total', co_status = 'Received' WHERE co_ID = '$coid'";
	mysqli_query($con, $lastQuery);
	header("location:../agent/products.php?walkIn=successful&checkout=successful");
} 

if($row1['co_method'] == "COD"){
	if($total < 1000){
		$total = $total + 50;
	}

	$lastQuery2 = "UPDATE client_order SET co_payment = '$total', co_status = 'Delivering' WHERE co_ID = '$coid'";
	mysqli_query($con, $lastQuery2);
	header("location:../agent/products.php?phoneOrder=delivering&checkout=successful");
}

?>