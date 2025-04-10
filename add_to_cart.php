<?php
session_start();
include 'db/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Check if item already in cart
$check = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND product_id = ?");
$check->bind_param("ii", $user_id, $product_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    // Item exists, increase quantity
    $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
} else {
    // New item
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

header("Location: products.php");
exit();
