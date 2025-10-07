<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(404);
    echo "<h1>Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    echo "<hr>";
    echo "<i>Apache/2.4.58 (Ubuntu) Server at " . $_SERVER['HTTP_HOST'] . " Port " . $_SERVER['SERVER_PORT'] . "</i>";
    exit();
}

// If admin is logged in, redirect to dashboard
header("Location: dashboard.php");
exit();
?>
