<?php
header('Content-Type: application/json'); // JSON response के लिए header सेट करें

// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Debugging: Check if ID is received
if (!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "ID is missing!"]);
    exit();
}

$id = intval($_GET['id']); // ID को integer में convert करें

// Debugging: Check if ID is valid
if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid ID"]);
    exit();
}

// Check if record exists
$check_sql = "SELECT * FROM websites WHERE id = $id";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM websites WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute and check if deletion was successful
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Website deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "SQL Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No record found with this ID"]);
}

$conn->close();
?>
