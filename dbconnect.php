<?php
$config = parse_ini_file("/var/www/private/db-config.ini", true);

// Check if config loaded successfully
if ($config === false) {
    die("Failed to load config file.");
}

// Assign database credentials
$servername = $config['database']['servername'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$database = $config['database']['dbname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(" Database connection failed: " . $conn->connect_error);
}
?>