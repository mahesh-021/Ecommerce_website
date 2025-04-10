<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecommerce_db"; // Make sure to create this DB

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
