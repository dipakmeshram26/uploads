<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT category FROM websites ORDER BY category ASC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="styles.css">
     <link rel="stylesheet" href="categories.css">
<link rel="stylesheet" href="catt.css">
    </head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php"><img src="site logo.png" alt=""></a>
        <h2>Admin Panel</h2>
    </div>
         
          <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="categories.php">Categories</a></li> <!-- Link to categories page -->
            <li><a href="about.html">About</a></li>
            <li><a href="register.php">Register</a></li> <!-- Open Login Popup -->
            <a href="logout.php">Logout</a>
        </ul>
             
    </nav>
    <div class="categories-container">
        <h1>Categories</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='category-box'>";
                echo "<a href='category_vi.php?category=" . urlencode($row['category']) . "'>" . htmlspecialchars($row['category']) . "</a>";
                echo "</div>";
   
            }
        } else {
            echo "<p>No categories found.</p>";
        }
        ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
