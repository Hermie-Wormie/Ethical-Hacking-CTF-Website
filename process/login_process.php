<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../dbconnect.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../login.php");
    exit();
}

// Get user input (INTENTIONALLY VULNERABLE - NO SANITIZATION)
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Debug mode
$debug = isset($_POST['debug']) && $_POST['debug'] == '1';

try {
    // VULNERABLE UNION-based SQL Injection Query
    $query = "SELECT member_id, first_name, last_name, email, password, is_admin FROM Users WHERE email = '$email' AND password = '$password'";
    
    if ($debug) {
        echo "<!-- DEBUG: Query = $query -->";
    }
    
    $result = $conn->query($query);
    
    if (!$result) {
        if ($debug) {
            die("SQL Error: " . $conn->error);
        } else {
            die("Login failed!");
        }
    }
    
    // Check if we got any results
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if ($debug) {
            echo "<!-- DEBUG: Found user data: " . json_encode($user) . " -->";
        }
        
        // Set session variables
        $_SESSION['user_id'] = $user['member_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['is_admin'] = $user['is_admin'];
        
        // Simple redirect logic based on is_admin value
        if ($user['is_admin'] == 1) {
            // User is admin - redirect to admin page
            if ($debug) {
                echo "<!-- DEBUG: Admin detected, redirecting to admin page -->";
            }
            $_SESSION['admin_logged_in'] = true; // Set admin session flag
            header("Location: ../admin/admin_index.php");
            exit();
        } else {
            // Regular user - redirect to welcome page
            if ($debug) {
                echo "<!-- DEBUG: Regular user, redirecting to welcome page -->";
            }
            header("Location: ../welcome.php");
            exit();
        }
    } else {
        // No results found - login failed
        if ($debug) {
            echo "<!-- DEBUG: No matching user found -->";
        }
        
        echo "<!DOCTYPE html>";
        echo "<html><head><title>Login Failed</title>";
        echo "<style>body{font-family:Arial;padding:50px;background:#f4f4f4;text-align:center;}";
        echo ".error{background:white;padding:30px;border-radius:10px;max-width:500px;margin:auto;}";
        echo "</style></head><body>";
        echo "<div class='error'>";
        echo "<h2>❌ Login Failed!</h2>";
        echo "<p>Invalid email or password.</p>";
        echo "<p><a href='../login.php'>← Try again</a></p>";
        echo "</div></body></html>";
    }
    
} catch (Exception $e) {
    if ($debug) {
        echo "Error: " . $e->getMessage();
    } else {
        echo "An error occurred. Please try again.";
    }
}

$conn->close();
?>