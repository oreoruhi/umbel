<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "umbel_db";

// create connection
$con = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
} 
?>