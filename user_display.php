<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM websites ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Submitted Websites</title>
    <link rel="stylesheet" href="user_display.css">
</head>
<body>
    <div class="container">
        <h1>All tools & Websites</h1>
        <a href="index.html" class="back-button">Go Back to home</a>

        
        
        <div id="website-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="site-card">
                   <?php   echo "<img src='" . htmlspecialchars($row['logo']) . "' alt='Website Logo' class='website-logo'>";?>
                    <div class="site-info">
                        <h3><?php echo $row['site_name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <a href="<?php echo $row['site_link']; ?>" target="_blank">Visit Site</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
