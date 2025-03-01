<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch website data along with sub-admin name
$sql = "SELECT websites.id, websites.site_name, websites.description, websites.site_link, 
        websites.logo, websites.category, websites.visibility, websites.submitted_by,
        sub_admins.sub_admin_name 
        FROM websites
        LEFT JOIN sub_admins ON websites.submitted_by = sub_admins.id
        ORDER BY websites.created_at DESC";

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
        echo "<p><strong>ID:</strong> " . htmlspecialchars($row['id']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";

        // Corrected logic to display "Submitted By"
        if (!empty($row['sub_admin_name'])) {
            echo "<p><strong>Submitted By:</strong> " . htmlspecialchars($row['sub_admin_name']) . "</p>";
        } else {
            echo "<p><strong>Submitted By:</strong> Admin</p>";
        }

        echo "<a href='" . htmlspecialchars($row['site_link']) . "' target='_blank'>Visit Website</a>";

        // Edit button
        echo "<button onclick='openEditForm(" . $row['id'] . ")' class='edit-btn'>Edit</button>";

        // Delete button
        echo "<button onclick='deleteWeb(" . $row['id'] . ")' class='delete-btn'>Delete</button>";

        // Toggle visibility button
        echo "<button onclick='toggleVisibility(" . json_encode($row['id']) . ")' class='toggle-btn'>" . ucfirst($row['visibility']) . "</button>";

        // Visibility status
        echo "<p><strong>Visibility:</strong> " . ucfirst($row['visibility']) . "</p>";

        echo "</div>";
    }
} else {
    echo "<p>No websites found.</p>";
}

// Close connection
$conn->close();
?>
