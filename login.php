<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="form-container">
    <h2>Login</h2>
    <form action="process/login_process.php" method="POST" id="login-form">
        <input type="text" name="email" placeholder="Email" 
               value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
        
        <input type="password" name="password" placeholder="Password" 
               value="<?php echo htmlspecialchars($_GET['password'] ?? ''); ?>">
        
        <button type="submit">Login</button>
    </form>
    
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>