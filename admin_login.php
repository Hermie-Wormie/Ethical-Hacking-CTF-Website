<?php
session_start();

// If gate not passed → fake "Not Found"
if (!isset($_SESSION['admin_gate']) || $_SESSION['admin_gate'] !== true) {
    http_response_code(404); // Send 404 header
    echo "<h1>Not Found</h1>";
    echo "<p>The requested URL was not found on this server.</p>";
    echo "<hr>";
    echo "<i>Apache/2.4.58 (Ubuntu) Server at " . $_SERVER['HTTP_HOST'] . " Port " . $_SERVER['SERVER_PORT'] . "</i>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
  <h2>Admin Login</h2>
  <form method="POST" action="process/adminlogin_process.php">
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
  </form>
</body>
</html>