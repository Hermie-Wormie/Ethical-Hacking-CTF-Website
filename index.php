<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="..css/style.css"> <!-- External CSS -->
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div><strong>🛒 My Shop</strong></div>
        <div>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="welcome.php">My Account</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        Welcome to My Shop – Great Deals Every Day!
    </div>

    <!-- Products -->
    <div class="products">
        <div class="product">
            <img src="https://via.placeholder.com/200x150" alt="Product 1">
            <h3>Product 1</h3>
            <p>$20.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/200x150" alt="Product 2">
            <h3>Product 2</h3>
            <p>$35.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="product">
            <img src="https://via.placeholder.com/200x150" alt="Product 3">
            <h3>Product 3</h3>
            <p>$15.00</p>
            <button>Add to Cart</button>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> My Shop. All Rights Reserved.</p>
    </div>

</body>
</html>
