Ɓ<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
include 'db_connect.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    
    $sql = "UPDATE medicines SET name='$name', stock='$stock', price='$price' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
    exit();
}

$sql = "SELECT * FROM medicines WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Medicine</title>
</head>
<body>
    <h2>Edit Medicine</h2>
    <form method="POST">
        <label>Medicine Name:</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        
        <label>Stock:</label><br>
        <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required><br><br>
        
        <label>Price (KES):</label><br>
        <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required><br><br>
        
        <button type="submit">Update</button>
        <a href="dashboard.php">Cancel</a>
    </form>
</body>
</html>