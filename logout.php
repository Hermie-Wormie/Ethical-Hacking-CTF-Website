<?php
// logout.php - Place this in your root directory

session_start();

// Store a logout message before destroying session (optional)
$logout_message = "You have been successfully logged out.";

// Unset all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Optional: Set a temporary message using a cookie (for displaying on login page)
setcookie("logout_message", $logout_message, time() + 5, "/");

// Redirect to login page or home page
header("Location: login.php");
exit();
?>
