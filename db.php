<?php
// Database connection file

// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "crm_project";

// Create connection using mysqli
$conn = mysqli_connect($host, $user, $password, $database);

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to utf8
mysqli_set_charset($conn, "utf8");

// Optional: show message that connection is successful (remove later)
// echo "Connected successfully";
?>
