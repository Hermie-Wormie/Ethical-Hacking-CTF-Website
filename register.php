<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="css/register.css">
  <script>
    function validateForm() {
      let password = document.getElementById("password").value;
      let confirmPassword = document.getElementById("confirm_password").value;
      let checkbox = document.getElementById("terms");

      if (password !== confirmPassword) {
        alert("❌ Passwords do not match!");
        return false; // stop form submit
      }

      if (!checkbox.checked) {
        alert("❌ You must agree to the terms before registering!");
        return false;
      }

      return true; // allow form submit
    }
  </script>
</head>
<body>
  <h2>Create Your Account</h2>
  <form action="process/register_process.php" method="POST" onsubmit="return validateForm()">
    <input type="text" name="first_name" placeholder="First Name"><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br>
    <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password" required><br>

    <label>
      <input type="checkbox" id="terms"> I agree to the Terms & Conditions
    </label><br><br>

    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login Here</a></p>
</body>
</html>
