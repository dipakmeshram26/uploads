<?php
session_start();

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
    $admin_username = $_POST["username"];
    $admin_password = $_POST["password"];

     // Use prepared statements to avoid SQL injection
    $sql = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $sql->bind_param("s", $admin_username); // 's' means string
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($admin_password, $row["password"])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin_username;
             $_SESSION['user_role'] = 'admin'; // Set user role to admin

               $_SESSION['login_message'] = "Login Successful! Welcome " . $_SESSION['admin_username']; // Set message

            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid username!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="log_register.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href=""> <img src="site logo.png" alt="">Hacker<span class="red">AI</span></a>

        </div>

        <ul class="nav-links">
            <li><a href="../index.html">Home</a></li>

            <li><a href="about.html">About</a></li>
            <li><a href="../subadmin_panel/login_subadmin.php">Sub-Admin Login</a></li>


        </ul>
    </nav>
    <div id="logid">
        <span class="goll"></span>
        <span class="goll2"></span>
        <div class="log-form-container">
            <div class="admin-log-left">
                <div class="log-logo">
                    <a href=""><img src="site logo.png" alt=""></a>
                </div>
                <h1>Welcome back</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, nemo hic, assumenda harum nulla placeat
                    architecto
                    similique suscipit vitae voluptate vero aut corrupti non quod! Voluptatem magnam iste est ex.</p>
            </div>

            <div class="admin-log-right">
                <h2>Admin Login</h2>
                <p>Welcome Back , Please Log In Your Account</p>
                <form method="POST" class="login-form">
                    <div class="form-group">

                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.setAttribute('autocomplete', 'new-password');
            });
        });
    </script>
</body>

</html>