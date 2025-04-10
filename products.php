<?php
session_start();
include 'db/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - MyShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🛍️ MyShop - Products</h1>
        <nav class="navbar">
            <a href="index.php">🏠 Home</a>
            <a href="cart.php" class="cart-link">🛒 Cart</a>
            <span class="user-info">
                👤 <?= isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?>
            </span>
            <a href="logout.php">🚪 Logout</a>
        </nav>
    </header>

    <main class="container">
        <h2>Available Products</h2>
        <div class="products-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <strong>$<?php echo $row['price']; ?></strong>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> MyShop</p>
    </footer>
</body>
</html>
