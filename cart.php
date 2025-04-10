<?php
session_start();
include 'db/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT cart.id AS cart_id, products.name, products.price, products.image, cart.quantity
FROM cart 
JOIN products ON cart.product_id = products.id 
WHERE cart.user_id = $user_id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - MyShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🛒 Your Cart</h1>
        <nav class="navbar">
            <a href="products.php">← Continue Shopping</a>
            <a href="logout.php">🚪 Logout</a>
        </nav>
    </header>

    <main class="container">
        <?php if ($result->num_rows > 0): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                while ($row = $result->fetch_assoc()): 
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td class="cart-item">
                        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <div class="cart-item-details">
                            <strong><?php echo $row['name']; ?></strong>
                        </div>
                    </td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>$<?php echo number_format($row['price'], 2); ?></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="POST">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="cart-total">
            <h3>Total: $<?php echo number_format($total, 2); ?></h3>
            <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        </div>
        <?php else: ?>
            <div class="empty-cart">
                <p>🛒 Your cart is currently empty.</p>
                <a href="products.php" class="btn btn-primary">Start Shopping</a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> MyShop</p>
    </footer>
</body>
</html>


