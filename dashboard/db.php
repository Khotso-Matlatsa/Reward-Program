<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "ecommerce";

// Create connection
$conn = new mysqli($host, $user, $pass, $db, 3308);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>