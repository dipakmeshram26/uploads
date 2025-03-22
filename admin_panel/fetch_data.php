<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch website data without JOIN
$sql = "SELECT id, site_name, description, site_link, logo, category, visibility, submitted_by FROM websites ORDER BY created_at DESC";

// Run the query
$result = $conn->query($sql);

// Debug: Check if query ran successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if data exists
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='website-box'>";
        echo "<img src='" . htmlspecialchars($row['logo']) . "' alt='Website Logo' class='website-logo'>";
        echo "<h3>" . htmlspecialchars($row['site_name']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        
        // Directly displaying 'submitted_by' as it contains name
        if (!empty($row['submitted_by'])) {
            echo "<p><strong>Submitted By:</strong> " . htmlspecialchars($row['submitted_by']) . "</p>";
        } else {
            echo "<p><strong>Submitted By:</strong> Admin</p>";
        }
        
        echo "<a href='" . htmlspecialchars($row['site_link']) . "' target='_blank'>Visit Website</a>";
        
        // Edit button
        echo "<button onclick='openEditForm(" . $row['id'] . ")' class='edit-btn'><img src='edit-btn.png'></button>";
        
        echo "<div class='btn2'>";
        // Delete button
        echo "<button onclick='deleteWeb(" . $row['id'] . ")' class='delete-btn'>Delete</button>";
        
        // Toggle visibility button
        echo "<button onclick='toggleVisibility(" . json_encode($row['id']) . ")' class='toggle-btn'>" . ucfirst($row['visibility']) . "</button>";
        echo "</div>";

        // Visibility status
        echo "<div class='visib'> " . ucfirst($row['visibility']) . "</div>";

        echo "</div>";
    }
} else {
    echo "<p>No websites found.</p>";
}

// Close connection
$conn->close();
?>