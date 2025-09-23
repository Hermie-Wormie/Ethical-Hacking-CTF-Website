<?php
session_start();
require_once '../dbconnect.php';

// INTENTIONALLY VULNERABLE CODE FOR CTF
$email = $_POST['email'];
$password = $_POST['password'];

// Vulnerable query - allows SQL injection
$query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['member_id'];
    $_SESSION['email'] = $user['email'];
    
    // Check if user is admin
    $admin_query = "SELECT * FROM Admin WHERE admin_email = '$email'";
    $admin_result = $conn->query($admin_query);
    
    if ($admin_result && $admin_result->num_rows > 0) {
        $_SESSION['is_admin'] = true;
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../welcome.php");
    }
} else {
    echo "Login failed!";
    // Uncomment for CTF hints (optional)
    // echo "<!-- Debug: Query was: $query -->";
}
?>