<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Agar 'query' parameter mila toh matching categories fetch karo
if (isset($_GET['query'])) {
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // Similar categories fetch karne ka SQL query
    $sql = "SELECT DISTINCT category_name FROM category WHERE category_name LIKE '%$searchTerm%' LIMIT 10";
    $result = $conn->query($sql);

    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['category_name'];
        }
    }

    // JSON response bhejo
    echo json_encode($categories);
}

$conn->close();
?>
