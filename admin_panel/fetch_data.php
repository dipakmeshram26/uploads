<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all website data
$sql = "SELECT id, site_name, description, site_link, logo, category, created_at FROM websites ORDER BY created_at DESC";
$result = $conn->query($sql);

// Debug: Check if query ran successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}
  
             echo "<div class='totle'>";
             echo "Total websites found: ". $result->num_rows . "<br>";
            echo "</div>";
            
 
// Check if data exists
if ($result->num_rows > 0) {
      
    while ($row = $result->fetch_assoc()) {
        echo "<div class='website-box'>";
        echo "<img src='" . $row['logo'] . "' alt='Website Logo' class='website-logo'>";
        echo "<h3>" . htmlspecialchars($row['site_name']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<span class='ids'>". htmlspecialchars($row['id']) . "</span> </p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        echo "<a href='" . htmlspecialchars($row['site_link']) . "' target='_blank'>Visit Website</a>";
        echo "<td><button onclick='deleteWeb(" . $row['id'] . ")' class='delete-btn'>Delete</button></td>";
        echo "</div>";
    }
} else {
    echo "<p>No websites found.</p>";
}

// Close connection
$conn->close();
?>
