<?php
session_start();
$conn = new mysqli("localhost", "root", "", "website_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sub-Admin Name Session से लीजिए
$sub_admin_name = $_SESSION['sub_admin_name']; 

$sql = "SELECT * FROM websites WHERE submitted_by = '$sub_admin_name' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='website-box'>";
         echo "<img src='" . htmlspecialchars($row['logo']) . "' alt='Website Logo' class='website-logo'>";
        echo "<h3>" . htmlspecialchars($row['site_name']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        echo "<p><strong>Status:</strong> " . ($row['visibility'] == 'private' ? 'Private' : 'Public') . "</p>";
        
        
        echo "<p><strong>Submitted By:</strong> " . htmlspecialchars($row['submitted_by']) . "</p>";
      
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
    echo "<p class='no-websites'>No websites found.</p>";
}
$conn->close();
?>
