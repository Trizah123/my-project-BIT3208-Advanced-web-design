<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Simple hardcoded credentials (for testing)
$valid_username = "admin";
$valid_password = "1234";

if ($username == $valid_username && $password == $valid_password) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.html");
    exit();
} else {
    echo "Invalid username or password. <a href='login.html'>Try again</a>";
}
?>