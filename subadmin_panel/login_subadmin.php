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
</head>
<body>
    <h2>Sub-Admin Login</h2>
    <form action="login_subadmin.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
