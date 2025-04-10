<?php session_start(); include 'db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - MyShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🛍️ MyShop</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php else: ?>
                <span>Hello, <?= $_SESSION['user']; ?>!</span>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Welcome to MyShop!</h2>
            <p>Your one-stop destination for amazing products at great prices.</p>
            <a class="btn" href="products.php">Start Shopping</a>
        </section>

        <section class="features">
            <div class="feature">
                <h3>🛒 Easy to Use</h3>
                <p>Simple shopping experience with a smooth interface.</p>
            </div>
            <div class="feature">
                <h3>🔐 Secure Login</h3>
                <p>Keep your data safe with secure login and logout features.</p>
            </div>
            <div class="feature">
                <h3>🚚 Fast Checkout</h3>
                <p>Quick and seamless checkout process.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y"); ?> MyShop. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
