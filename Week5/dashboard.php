<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
include 'db_connect.php';

$sql = "SELECT * FROM medicines";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MediStore - Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #2c7da0; color: white; }
        .logout { background: red; color: white; padding: 5px 10px; text-decoration: none; }
        .add { background: green; color: white; padding: 10px; text-decoration: none; display: inline-block; margin-bottom: 20px; }
        .edit { background: blue; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .delete { background: red; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
    </style>
</head>
<body>

<h2>MediStore Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['user']; ?> | <a href="logout.php" class="logout">Logout</a></p>

<a href="add_medicine.php" class="add">+ Add New Medicine</a>

<h3>Medicine Inventory</h3>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Medicine Name</th>
        <th>Stock</th>
        <th>Price (KES)</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['stock']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td>
            <a href="edit_medicine.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
            <a href="delete_medicine.php?id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Delete this medicine?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>