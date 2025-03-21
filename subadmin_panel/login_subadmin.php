<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "website_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch sub-admin details from database
    $sql = "SELECT * FROM sub_admins WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Login successful
            session_start();
            $_SESSION['sub_admin_id'] = $row['id'];
            $_SESSION['sub_admin_name'] = $row['name'];
            header("Location: dashboard_subadmin.php"); // Redirect to sub-admin dashboard
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No sub-admin found with that email.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Admin Login</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <a href="home.php"><img src="../site logo.png" alt="Site Logo"></a>
    </div>
    <!-- <h2>Sub-Admin <span class="red">Panel</span></h2> -->
    <ul class="nav-links">
        <li><a href="subadmin_dashboard.php">Dashboard</a></li>
        <li><a href="submit_website.php">Submit Website</a></li>
        <li><a href="view_websites.php">View Websites</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<div id="sub-log"> 
    <span class= "goll"></span>
    <span class= "goll2"></span>
    <div class="sub-log-itmes"> 
      <div class="sub-log-left">
        <div class="sub-log-logo">
            <img src="../site logo.png" alt="">
        </div>
      <h1>Welcome back</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, nemo hic, assumenda harum nulla placeat architecto similique suscipit vitae voluptate vero aut corrupti non quod! Voluptatem magnam iste est ex.</p>
     </div> 
    <div class="sub-log-right"> 
    <h2>Sub-Admin Login</h2>
    <p>Welcome Back , Please Log In Your Account</p>
    <form action="login_subadmin.php" method="POST" class="logform">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Your Gmail " required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter Your Password" required><br><br>

        <button type="submit">Login</button>
    </form>
    </div>
    </div>
    </div>
</body>
</html>
