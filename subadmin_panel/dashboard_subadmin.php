<?php
session_start();

// Check if sub-admin is logged in
if (!isset($_SESSION['sub_admin_id'])) {
    header("Location: login_subadmin.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch sub-admin's name from the sub_admins table
$sub_admin_id = $_SESSION['sub_admin_id'];
$sub_admin_sql = "SELECT sub_admin_name FROM sub_admins WHERE id = '$sub_admin_id'";
$sub_admin_result = $conn->query($sub_admin_sql);

// Check if the query was successful and fetch the result
if ($sub_admin_result->num_rows > 0) {
    $sub_admin_data = $sub_admin_result->fetch_assoc();
    $sub_admin_name = $sub_admin_data['sub_admin_name'];
} else {
    $sub_admin_name = "Unknown"; // Default if no name found
}


// Fetch total number of websites submitted by the sub-admin
$sub_admin_id = $_SESSION['sub_admin_id'];
$total_sql = "SELECT COUNT(*) AS total_websites FROM websites WHERE submitted_by = '$sub_admin_id'";
$total_result = $conn->query($total_sql);
$total_websites = $total_result->fetch_assoc()['total_websites'];

// Fetch recent websites (for display)
$recent_sql = "SELECT * FROM websites WHERE submitted_by = '$sub_admin_id' ORDER BY created_at DESC LIMIT 5";
$recent_result = $conn->query($recent_sql);

// Fetch websites submitted by this sub-admin
$sql = "SELECT * FROM websites WHERE submitted_by = '$sub_admin_id'";
$result = $conn->query($sql);

// Check for errors in query execution
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
       
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="logo">
        <a href="home.php"><img src="site logo.png" alt="Site Logo"></a>
    </div>
    <h2>Sub-Admin <span class="red">Panel</span></h2>
    <ul class="nav-links">
        <li><a href="subadmin_dashboard.php">Dashboard</a></li>
        <li><a href="submit_website.php">Submit Website</a></li>
        <li><a href="view_websites.php">View Websites</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- Sub-Admin Dashboard Content -->
<div class="dashboard-container">
    <div class="home-container">
        <h3>Hello, <?php echo $_SESSION['sub_admin_name']; ?>!</h3>
        <h1>Welcome to the Sub-Admin Panel</h1>
        <h4>Manage Your Websites</h4>
        <p>Search websites:</p>
        
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search websites...">
            <button class="srch">🔍</button>
        </div>
        <div id="search-results" class="results-container"></div>

        <div class="buttons">
            <button id="openFormBtn">Submit Website</button>
            <a href="view_websites.php" class="btn">View Submitted Websites</a>
        </div>
    </div>

    <!-- Popup Form -->
    <div id="popupForm" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Submit Your Website</h2>
            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <label>Website Name:</label>
                <input type="text" name="site_name" placeholder="Enter Tool Name" required>

                <label>Description:</label>
                <textarea name="description" placeholder="Enter Tool details" required></textarea>

                <label>Website Link:</label>
                <input type="url" name="site_link" placeholder="Enter Tool link" required>

                <label>Category:</label>
                <input type="text" name="category" placeholder="Enter Tool Category" required>

                <!-- Public / Private Radio Buttons -->
                <label>Visibility:</label>
                <input type="radio" name="visibility" value="public" checked> Public
                <input type="radio" name="visibility" value="private"> Private

                <div id="sub-clos">
                    <button type="submit" class="submit">Submit</button>
                    <button type="button" id="closeFormBtn">x</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Your Submitted Websites Table -->
    <h3>Your Websites</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Website Name</th>
            <th>Category</th>
            <th>Status</th>
            <th>Visibility</th>
                <th>Submitted By</th> <!-- Sub-admin Name Column -->
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['site_name'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . ($row['visibility'] == 'private' ? 'Private' : 'Public') . "</td>";
                echo "<td><button onclick='toggleVisibility(" . $row['id'] . ")'>" . ucfirst($row['visibility']) . "</button></td>";
               
                  // Display the sub-admin name
                           echo "<td>" . htmlspecialchars($_SESSION['sub_admin_name']) . "</td>"; // Sub-admin Name

           
                echo "<td>
                        <a href='edit_website.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='delete_website.php?id=" . $row['id'] . "'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No websites found.</td></tr>";
        }
        ?>
    </table>
</div>

<script>
    // Popup form functionality
    document.getElementById('openFormBtn').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'flex';
    });

    document.getElementById('closeFormBtn').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'none';
    });

    document.querySelector('.close-btn').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'none';
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
