<?php
session_start();

$gate_password = "letmein123"; //password at the login gate

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['access_password'] === $gate_password) {
        $_SESSION['admin_gate'] = true;   // mark access granted
        header("Location: admin_login.php");
        exit;
    } else {
        $error = "❌ Wrong access password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Access</title></head>
<body>
  <h2>Enter Admin Access Password</h2>
  <form method="POST">
      <input type="password" name="access_password" required>
      <button type="submit">Enter</button>
  </form>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>