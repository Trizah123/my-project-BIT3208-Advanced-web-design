<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
include 'db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM medicines WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: dashboard.php");
exit();
?>