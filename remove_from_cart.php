<?php
session_start();
include 'db/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$cart_id = $_POST['cart_id'];
$conn->query("DELETE FROM cart WHERE id = $cart_id");

header("Location: cart.php");
exit();
