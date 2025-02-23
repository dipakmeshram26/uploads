<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, site_name, description, site_link, image, created_at FROM websites ORDER BY created_at DESC";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    // Har record ke saath ek delete button ka link bhi bhej rahe hain
    $row["delete_button"] = '<button class="delete-btn" data-id="' . $row["id"] . '" data-name="' . $row["site_name"] . '">Delete</button>';
    
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);

$conn->close();
?>
