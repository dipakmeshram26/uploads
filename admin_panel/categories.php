<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all categories from websites table
$sql = "SELECT category FROM websites";
$result = $conn->query($sql);

// Array to store unique categories
$all_categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories = explode(',', $row['category']); // Categories को अलग-अलग करें
        foreach ($categories as $category) {
            $category = trim($category); // Extra spaces remove करें
            if (!empty($category)) {
                $all_categories[$category] = $category; // Duplicate हटाने के लिए associative array यूज़ करें
            }
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="catt.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php"><img src="site logo.png" alt=""></a>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="register.php">Register</a></li>
            <a href="logout.php">Logout</a>
        </ul>
    </nav>

    <div id="cat">
        <h1>Categories</h1>
        <p>Explore our organized collection of tools and resources</p>
        <div class="categories-container">
            <?php
            if (!empty($all_categories)) {
                foreach ($all_categories as $category) {
                    echo "<div class='category-box'>";
                    echo "<a href='category_vi.php?category=" . urlencode($category) . "'>" . htmlspecialchars($category) . "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No categories found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
