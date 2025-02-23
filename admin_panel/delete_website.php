<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "website_db");
    $id = $_GET['id'];
    $conn->query("DELETE FROM websites WHERE id='$id'");
    header("Location: dashboard.php");
}
?>
