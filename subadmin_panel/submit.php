<?php
// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if sub-admin is logged in
if (!isset($_SESSION['sub_admin_id']) && !isset($_SESSION['admin_name'])) {
    header("Location: login_subadmin.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['site_name']) || empty($_POST['description']) || empty($_POST['site_link']) || empty($_POST['category'])) {
        die("Error: All fields are required.");
    }

    $site_name = trim($_POST['site_name']);
    $description = trim($_POST['description']);
    $site_link = trim($_POST['site_link']);
    $category = trim($_POST['category']);
    $visibility = isset($_POST['visibility']) && $_POST['visibility'] === 'private' ? 'private' : 'public';

    // Validate URL
    if (!filter_var($site_link, FILTER_VALIDATE_URL)) {
        die("Error: Invalid website link.");
    }

    // Validate & sanitize inputs
    $site_name = $conn->real_escape_string($site_name);
    $description = $conn->real_escape_string($description);
    $site_link = $conn->real_escape_string($site_link);
    $category = $conn->real_escape_string($category);

    // Default logo
    $logo = "https://www.google.com/s2/favicons?sz=256&domain=" . parse_url($site_link, PHP_URL_HOST);

    // If the sub-admin uploads a logo
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/logos/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $image_path = $target_dir . $image_name;

        // Check if image is valid
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            die("Error: Only JPG, PNG, and GIF images are allowed.");
        }

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $logo = $image_path;
        } else {
            die("Error: File upload failed.");
        }
    }

    // ✅ Store Direct Name Instead of ID
    if (isset($_SESSION['sub_admin_id'])) {
        $submitted_by = $_SESSION['sub_admin_name']; // Sub-admin name
    } else {
        $submitted_by = "Admin"; // Default admin name
    }

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO websites (site_name, description, site_link, logo, category, visibility, created_at, submitted_by) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssss", $site_name, $description, $site_link, $logo, $category, $visibility, $submitted_by);

    // Execute query
    if ($stmt->execute()) {
        header("Location: dashboard_subadmin.php?success=1");
        exit();
    } else {
        die("Execution failed: " . $stmt->error);
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
