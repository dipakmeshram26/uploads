 

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

// Fetch only public websites
$sql = "SELECT id, site_name, description, site_link, logo, category FROM websites WHERE visibility='public' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class='website-box'>
            <img src='<?php echo htmlspecialchars($row['logo']); ?>' alt='Website Logo' class='website-logo'>
            <h3><?php echo htmlspecialchars($row['site_name']); ?></h3>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <!-- <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p> -->
            <div class="vst-btn"> 
                 <a href='<?php echo htmlspecialchars($row['site_link']); ?>' target='_blank'>Visit Website</a>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No public websites available.</p>";
}

$conn->close();
?>
