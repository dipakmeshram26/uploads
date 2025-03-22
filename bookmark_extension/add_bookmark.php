<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data is received
if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['category']) && isset($_POST['description'])) {
    // Get POST data from the extension (name, URL, category, description)
    $websiteName = $_POST['name'];
    $websiteUrl = $_POST['url'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Sanitize inputs to prevent SQL injection
    $websiteName = $conn->real_escape_string($websiteName);
    $websiteUrl = $conn->real_escape_string($websiteUrl);
    $category = $conn->real_escape_string($category);
    $description = $conn->real_escape_string($description);

    // Fetch the domain name from URL
    $domain = parse_url($websiteUrl, PHP_URL_HOST);

    // Generate the logo URL using Google favicon
    $logo = "https://www.google.com/s2/favicons?sz=256&domain=" . $domain;

    // Insert data into the websites table
    $sql = "INSERT INTO websites (site_name, site_link, logo, category, description, visibility) 
            VALUES ('$websiteName', '$websiteUrl', '$logo', '$category', '$description', 'Public')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        // Log error if insert fails
        error_log("Error: " . $conn->error);
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    // Handle case where no POST data is received
    echo json_encode(['success' => false, 'error' => 'Missing name, url, category, or description']);
}

$conn->close();
?>
