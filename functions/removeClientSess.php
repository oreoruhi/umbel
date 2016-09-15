<?php
include("connect.php");

$coid = $_GET['coid'];



$sql = "DELETE FROM client_order WHERE co_ID = '$coid'";
mysqli_query($con, $sql);

header("location:../agent/products.php?clientSession=deleted");

?>