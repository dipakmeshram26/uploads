<?php
$conn = new mysqli("localhost", "root", "", "website_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get current visibility status
    $sql = "SELECT visibility FROM websites WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $new_visibility = ($row['visibility'] == 'public') ? 'private' : 'public';

    // Update database
    $update_sql = "UPDATE websites SET visibility='$new_visibility' WHERE id=$id";
    if ($conn->query($update_sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

$conn->close();
?>
