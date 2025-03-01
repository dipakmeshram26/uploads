<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $site_name = $_POST['site_name'];
    $description = $_POST['description'];
    $site_link = $_POST['site_link'];
    $category = $_POST['category'];
    $visibility = $_POST['visibility'];

    // Update the website data in the database
    $sql = "UPDATE websites SET site_name = ?, description = ?, site_link = ?, category = ?, visibility = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $site_name, $description, $site_link, $category, $visibility, $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1"); // Redirect after success
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
