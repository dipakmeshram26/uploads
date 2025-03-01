<?php
$conn = new mysqli("localhost", "root", "", "website_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $site_name = $conn->real_escape_string($_POST["site_name"]);
    $site_url = $conn->real_escape_string($_POST["site_url"]);
    $submitted_by = 1; // Replace with the actual user ID (dynamic session-based)

    $sql = "INSERT INTO websites (site_name, site_link, submitted_by) VALUES ('$site_name', '$site_url', '$submitted_by')";

    if ($conn->query($sql) === TRUE) {
        echo "Website added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
