<?php
// Enable error reporting for debugging (remove in production)
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

// Debug mode (comment out for production CTF)
$debug = false; // Set to true to see queries

try {
    // VULNERABLE QUERY - Allows SQL Injection
    $query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    
    if ($debug) {
        echo "<!-- DEBUG Query: $query -->";
    }
    
    $result = $conn->query($query);
    
    if (!$result) {
        // SQL error occurred
        if ($debug) {
            die("SQL Error: " . $conn->error . "<br>Query: " . $query);
        } else {
            // For CTF, give a hint about SQL errors
            die("Login failed! <!-- Hint: Your SQL syntax might have an error -->");
        }
    }
    
    if ($result->num_rows > 0) {
        // Login successful
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['user_id'] = $user['member_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        
        // Check if user is admin
        $admin_check = "SELECT * FROM Admin WHERE admin_email = '" . $user['email'] . "'";
        $admin_result = $conn->query($admin_check);
        
        if ($admin_result && $admin_result->num_rows > 0) {
            $_SESSION['is_admin'] = true;
            
            // Check if admin dashboard exists
            if (file_exists('../admin/dashboard.php')) {
                header("Location: ../admin/dashboard.php");
            } else {
                // Create a simple flag page if dashboard doesn't exist
                echo "<h1>Congratulations!</h1>";
                echo "<h2>FLAG{SQL_INJECTION_SUCCESS}</h2>";
                echo "<p>You successfully logged in as admin!</p>";
                echo "<a href='../logout.php'>Logout</a>";
            }
        } else {
            // Regular user login
            header("Location: ../welcome.php");
        }
        exit();
        
    } else {
        // Login failed
        echo "<!DOCTYPE html>";
        echo "<html><head><title>Login Failed</title>";
        echo "<style>body{font-family:Arial;padding:50px;background:#f4f4f4;}";
        echo ".error{background:white;padding:30px;border-radius:10px;max-width:500px;margin:auto;box-shadow:0 2px 10px rgba(0,0,0,0.1);}";
        echo "a{color:#667eea;text-decoration:none;}</style></head>";
        echo "<body><div class='error'>";
        echo "<h2>Login Failed!</h2>";
        echo "<p>Invalid email or password.</p>";
        
        if ($debug) {
            echo "<p><small>Query executed: " . htmlspecialchars($query) . "</small></p>";
            echo "<p><small>Rows returned: " . $result->num_rows . "</small></p>";
        }
        
        echo "<p><a href='../login.php'>Try again</a></p>";
        echo "</div></body></html>";
    }
    
} catch (Exception $e) {
    // Catch any exceptions
    if ($debug) {
        echo "Error: " . $e->getMessage();
    } else {
        echo "An error occurred. Please try again.";
        echo "<!-- Hint: Check your SQL syntax -->";
    }
}

$conn->close();
?>