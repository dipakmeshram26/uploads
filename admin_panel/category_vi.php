<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET category from URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

if (empty($category)) {
    die("Invalid category.");
}

// Fetch websites that have this category
$sql = "SELECT id, site_name, description, site_link, logo, category FROM websites WHERE FIND_IN_SET(?, category) > 0 ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category); ?> - Websites</title>
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="catt.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <a href="index.html">MyWebsite</a>
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="about.html">About</a></li>
        
        
    </ul>
</nav>
 
<div class="container">
     <h1>Websites in "<?php echo htmlspecialchars($category); ?>"</h1>
   <p>Explore our organized collection of tools and resources</p>
      <h1>Websites in <?php echo htmlspecialchars($category); ?></h1>
    <div class="website-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='website-box'>";
                echo "<img src='" . htmlspecialchars($row['logo']) . "' alt='Website Logo' class='website-logo'>";
                echo "<h3>" . htmlspecialchars($row['site_name']) . "</h3>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<a href='" . htmlspecialchars($row['site_link']) . "' target='_blank'>Visit Website</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No websites found in this category.</p>";
        }
        ?>
    </div>
    <a href="categories.php" class="btn">⬅ Back to Categories</a>

</div>

</body>
</html>

<?php
$conn->close();
?>
