<?php
session_start();

// Check if admin is logged in
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     http_response_code(404);
//     die("<h1>404 Not Found</h1><p>The page you requested does not exist.</p>");
// }
// 
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(404);
    echo "<h1>Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    echo "<hr>";
    echo "<i>Apache/2.4.58 (Ubuntu) Server at " . $_SERVER['HTTP_HOST'] . " Port " . $_SERVER['SERVER_PORT'] . "</i>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { width: 80%; margin: 40px auto; background: #fff; padding: 20px; border-radius: 8px; }
        h1 { color: #333; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; text-decoration: none; color: #007bff; }
        .nav a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <div class="nav">
            <a href="manage_users.php">Manage Users</a>
            <a href="site_settings.php">Site Settings</a>
            <a href="view_logs.php">View Logs</a>
            <a href="adminlogout.php">Logout</a>
        </div>
        <p>This is your admin dashboard. Use the navigation above to manage the website.</p>
    </div>
</body>
</html>