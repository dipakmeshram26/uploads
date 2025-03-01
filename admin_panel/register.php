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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $admin_name = $_POST["name"]; // New field for name
    $admin_username = $_POST["username"];
    $admin_password = $_POST["password"];
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);  // Hash the password

    // Insert the new admin into the database with the hashed password and name
    $sql = "INSERT INTO admin (name, username, password) VALUES ('$admin_name', '$admin_username', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="log_register.css">
</head>

<body>
     <div id="logid">
        <div class="form-container" autocomplete="off">
            <h2>Admin Registration</h2>
            <form method="POST" class="register-form" autocomplete="off">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>