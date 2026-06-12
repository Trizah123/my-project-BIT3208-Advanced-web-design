<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO medicines (name, stock, price) VALUES ('$name', '$stock', '$price')";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Medicine</title>
</head>
<body>
    <h2>Add New Medicine</h2>
    <form method="POST">
        <label>Medicine Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Stock:</label><br>
        <input type="number" name="stock" required><br><br>
        
        <label>Price (KES):</label><br>
        <input type="number" step="0.01" name="price" required><br><br>
        
        <button type="submit">Save</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>