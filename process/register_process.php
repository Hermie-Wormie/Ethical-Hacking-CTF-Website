<?php
require_once '../dbconnect.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

// INTENTIONALLY VULNERABLE - No input sanitization
$query = "INSERT INTO Users (first_name, last_name, email, password) 
          VALUES ('$first_name', '$last_name', '$email', '$password')";

if ($conn->query($query)) {
    echo "Registration successful!";
    header("Location: ../login.php");
} else {
    echo "Error: " . $conn->error;
}
?>