<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user information
require_once 'dbconnect.php';
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

// Fetch user details
$query = "SELECT first_name, last_name FROM Users WHERE member_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - My Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .welcome-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .user-info h2 {
            color: #333;
            margin-bottom: 15px;
        }
        
        .info-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-left: 4px solid #667eea;
        }
        
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #5a6fd8;
        }
        
        .btn-danger {
            background: #dc3545;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div><strong>🛒 My Shop</strong></div>
        <div>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="welcome.php">My Account</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
        
        <div class="user-info">
            <h2>Your Account Information</h2>
            <div class="info-item">
                <strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
            </div>
            <div class="info-item">
                <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
            </div>
            <div class="info-item">
                <strong>Member ID:</strong> #<?php echo htmlspecialchars($user_id); ?>
            </div>
            <div class="info-item">
                <strong>Account Status:</strong> <span style="color: green;">Active</span>
            </div>
        </div>
        
        <div class="actions">
            <a href="index.php" class="btn">Browse Products</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> My Shop. All Rights Reserved.</p>
    </div>
</body>
</html>
