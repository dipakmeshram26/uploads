<?php
// Start the session
session_start();

// Check if sub-admin is logged in
if (!isset($_SESSION['sub_admin_id'])) {
    header("Location: login_subadmin.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $site_name = $_POST['site_name'];
    $description = $_POST['description'];
    $site_link = $_POST['site_link'];
    $category = $_POST['category'];
    $visibility = $_POST['visibility'] == 'private' ? 'private' : 'public';

    // Validate & sanitize inputs
    $site_name = mysqli_real_escape_string($conn, $site_name);
    $description = mysqli_real_escape_string($conn, $description);
    $site_link = mysqli_real_escape_string($conn, $site_link);
    $category = mysqli_real_escape_string($conn, $category);

    // Default logo - If no image uploaded, fetch the favicon from the site URL
    $logo = "https://www.google.com/s2/favicons?sz=256&domain=" . parse_url($site_link, PHP_URL_HOST);

    // If the sub-admin uploads a logo
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/logos/"; // Directory to store uploaded logos
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Ensure the directory exists
        }

        $image_name = basename($_FILES["image"]["name"]);
        $image_path = $target_dir . time() . "_" . $image_name;

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $logo = $image_path;  // Use uploaded image if available
        }
    }

    // Insert website data into the database
    $stmt = $conn->prepare("INSERT INTO websites (site_name, description, site_link, logo, category, visibility, created_at, submitted_by) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)");
    $stmt->bind_param("sssssss", $site_name, $description, $site_link, $logo, $category, $visibility, $_SESSION['sub_admin_id']);

    // Execute query and check for errors
    if ($stmt->execute()) {
        header("Location: dashboard_subadmin.php?success=1"); // Redirect to dashboard after success
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
