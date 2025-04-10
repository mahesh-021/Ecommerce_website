<?php
session_start();
include 'db/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - MyShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="checkout-container">';

$cart_items = $conn->query("
    SELECT * FROM cart WHERE user_id = $user_id
");

if ($cart_items->num_rows > 0) {
    while ($item = $cart_items->fetch_assoc()) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
    }

    $conn->query("DELETE FROM cart WHERE user_id = $user_id");

    echo "<h2>✅ Order placed successfully!</h2>";
    echo "<a href='products.php'>⬅ Back to Shop</a>";
} else {
    echo "<h2>🛒 Your cart is empty.</h2>";
    echo "<a href='products.php'>Shop Now</a>";
}

echo '</div></body></html>';
?>

