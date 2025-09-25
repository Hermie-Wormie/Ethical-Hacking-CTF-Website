<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🛋️ My Furniture Market</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">🛋️ <strong>My Furniture Market</strong></div>
        <nav id="nav-links">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="welcome.php">My Account</a>
                <a href="logout.php" class="btn-logout">Logout</a>
            <?php else: ?>
                <a href="register.php">Register</a>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </nav>
        <div class="hamburger" id="hamburger">
            ☰
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Furniture That Fits Your Life</h1>
            <p>Timeless designs at unbeatable prices – crafted for comfort & style.</p>
            <a href="products.php" class="btn-primary">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="products">
        <h2>✨ Featured Items</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="https://via.placeholder.com/350x240" alt="Chair">
                <h3>Modern Chair</h3>
                <p class="price">$120</p>
                <button class="btn-add">Add to Cart</button>
            </div>

            <div class="product-card">
                <img src="https://via.placeholder.com/350x240" alt="Table">
                <h3>Wooden Table</h3>
                <p class="price">$250</p>
                <button class="btn-add">Add to Cart</button>
            </div>

            <div class="product-card">
                <img src="https://via.placeholder.com/350x240" alt="Sofa">
                <h3>Cozy Sofa</h3>
                <p class="price">$540</p>
                <button class="btn-add">Add to Cart</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> My Furniture Market. All Rights Reserved.</p>
    </footer>

</body>
</html>
