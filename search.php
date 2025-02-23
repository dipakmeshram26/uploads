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
            category LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='search-results'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='search-item'>";
            echo "<img src='" . $row['logo'] . "' alt='Website Logo' class='website-logo'>";
            echo "<h3><a href='" . $row["site_link"] . "' target='_blank'>" . $row["site_name"] . "</a></h3>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<span class='category'>" . $row["category"] . "</span>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No results found.</p>";
    }
}

$conn->close();
?>
