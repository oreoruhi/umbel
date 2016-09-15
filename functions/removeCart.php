<?php
session_start();
$key = array_search($_GET['id'],$_SESSION['cart'], $_SESSION['cart_qty']);
if($key !== false)
$_SESSION["cart"] = array_diff($_SESSION["cart"], array($_SESSION['cart'][$key]));
header("location: ../cart.php?removedProd=true");
?>