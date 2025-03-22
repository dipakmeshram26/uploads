<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["query"])) {
    $search = $conn->real_escape_string($_POST["query"]);
    $sql = "SELECT * FROM websites WHERE 
            site_name LIKE '%$search%' OR 
            description LIKE '%$search%' OR 
            category LIKE '%$search%' OR 
            visibility LIKE '%$search%'"; 

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='search-results'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='search-item'>";
            echo "<img src='" . $row['logo'] . "' alt='Website Logo' class='website-logo'>";
            echo "<h3><a href='" . $row["site_link"] . "' target='_blank'>" . $row["site_name"] . "</a></h3>";
            echo "<p>" . $row["description"] . "</p>";
            // echo "<span class='category'>" . $row["category"] . "</span>";
            echo "<spam class='vis-top-right'>" . htmlspecialchars($row["visibility"]). "</spam>";
             
             echo "<div class='links'>";
             echo "<a class='links-btn' href='" . htmlspecialchars($row['site_link']) . "' target='_blank'>Visit Website</a>";
            echo "</div>";
        // Action Buttons
            echo "<div class='buttons'>";
 
            echo "<button onclick='openEditForm(" . $row['id'] . ")' class='edit-btn'>Edit</button>";
            echo "<td><button onclick='deleteWeb(" . $row['id'] . ")' class='delete-btn'>Delete</button></td>";
         echo "<button onclick='toggleVisibility(" . json_encode($row['id']) . ")' class='visi-toggle-btn'>" . ucfirst($row['visibility']) . "</button>";
            echo "</div>";
             echo "</div>"; // Close search-item div
        }
        echo "</div>";
    } else {
        echo "<p>No results found.</p>";
    }
}

$conn->close();
?>
