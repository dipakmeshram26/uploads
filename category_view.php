<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT * FROM websites WHERE category = ?";
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <a href="index.html">MyWebsite</a>
    </div>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="signup.html" class="signup-btn">Sign Up</a></li>
    </ul>
</nav>

<div class="container">
    <h1>Websites in "<?php echo htmlspecialchars($category); ?>"</h1>
    <div class="website-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='website-box'>
                        <img src='uploads/{$row["image"]}' alt='Website Image'>
                        <h3>{$row["site_name"]}</h3>
                        <p>{$row["description"]}</p>
                        <a href='{$row["site_link"]}' target='_blank'>Visit Site</a>
                      </div>";
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
