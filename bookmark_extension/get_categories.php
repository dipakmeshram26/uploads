<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode([])); // Return empty array on error
}

if (isset($_GET['q'])) {
    $query = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT DISTINCT category FROM websites WHERE category LIKE '%$query%' LIMIT 5";
    $result = $conn->query($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }

    echo json_encode($categories);
}

$conn->close();
?>
