<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="popup_info.css">
    <link rel="stylesheet" href="admin1.css">
    <!-- <link rel="stylesheet" href="dashadmin.css"> -->
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php"><img src="site logo.png" alt=""></a>
        </div>
        <h2>Admin <span class="red">Panel</span> </h2>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="categories.php">Categories</a></li> <!-- Link to categories page -->
            <li><a href="about.html">About</a></li>
            <li><a href="register.php">Register</a></li> <!-- Open Login Popup -->
            <li><a href="logout.php">Logout</a></li>
        </ul>

    </nav>

    <div class="dashboard-container">
        
        <div class="home-container">
            <h3 class="wlcm">Hello,
            <?php echo $_SESSION['admin_username']; ?>!
        </h3>
        

        
        <h1>Welcome to Our Community</h1>
            <h4>Manage Your Tools</h4>
             <p>Search tools:</p>

            <div class="search-bar">
                <input type="text" id="search" placeholder="Search websites, tools, categories...">
                <button class="srch">🔍</button>
            </div>
            <div id="search-results" class="results-container"></div>


            <div class="buttons">
                <button id="openFormBtn">Submit Website</button>
                <!-- <a href=".container" class="btn">Submit a Website</a> -->
                <a href="user_display.php" class="btn">View Websites</a>

            </div>
        </div>

        <!-- Popup Form -->
        <div id="popupForm" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <h2>Submit Your Website</h2>
                <form action="submit.php" method="POST" enctype="multipart/form-data">
                    <label>Website Name:</label>
                    <input type="text" name="site_name" required>

                    <label>Description:</label>
                    <textarea name="description" required></textarea>

                    <label>Website Link:</label>
                    <input type="url" name="site_link" required>

                    <label>Category:</label>
                    <input type="text" name="category" required>

                    <button type="submit" class="submit" >Submit</button>
                    <button type="button" id="closeFormBtn">No</button>
                </form>
            </div>
        </div>



        <div class="display-container">
            <h2>Websites</h2>
          
            <div id="website-list"></div> <!-- Container for displaying websites -->
        </div>
        <div id="data-container"></div>






        <div class="website-boxes-container">
            <?php
            $conn = new mysqli("localhost", "root", "", "website_db");
            $result = $conn->query("SELECT * FROM websites");

            while ($row = $result->fetch_assoc()) {
                echo "<div class='website-box'>
                        <div class='box-header'>
                            <h4>{$row['site_name']}</h4>
                            <p>Category: {$row['category']}</p>
                        </div>
                        <div class='box-body'>
                            <p>ID: {$row['id']}</p>
                            <a href='delete_website.php?id={$row['id']}' class='delete-link'>Delete</a>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            var openFormBtn = document.getElementById("openFormBtn");
            var popupForm = document.getElementById("popupForm");
            var closeFormBtn = document.getElementById("closeFormBtn");
            var closeButton = document.querySelector(".close-btn");

            // Open Form on Button Click
            openFormBtn.addEventListener("click", function () {
                popupForm.style.display = "flex"; // Show Popup
            });

            // Close Form on Clicking "No" Button
            closeFormBtn.addEventListener("click", function () {
                popupForm.style.display = "none";
            });

            // Close Form on Clicking "X" Button
            closeButton.addEventListener("click", function () {
                popupForm.style.display = "none";
            });

            // Close Form When Clicking Outside the Form
            window.addEventListener("click", function (event) {
                if (event.target === popupForm) {
                    popupForm.style.display = "none";
                }
            });
        });



        document.addEventListener("DOMContentLoaded", function () {
            fetch("fetch_data.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("website-list").innerHTML = data;
                })
                .catch(error => console.error("Error fetching data:", error));
        });

        function deleteWeb(id) {
            console.log("Deleting ID:", id); // 🛠️ Debugging: ID check करें

            if (confirm("Are you sure you want to delete this website?")) {
                fetch("./delete.php?id=" + id)
                    .then(response => response.json()) // 🛠️ JSON format में parse करें
                    .then(data => {
                        console.log("Response from delete.php:", data); // 🛠️ Debugging Response

                        if (data.status === "success") {
                            alert(data.message);
                            document.getElementById("website-" + id).remove(); // UI से Remove करें
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error deleting data:", error));
            }
        }





        $(document).ready(function () {
            $("#search").keyup(function () {
                var query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: { query: query },
                        success: function (data) {
                            $("#search-results").html(data);
                        }
                    });
                } else {
                    $("#search-results").html("");
                }
            });
        });
        function fetchCategory(category) {
            let url = "fetch_data.php";
            if (category !== "All") {
                url += "?category=" + encodeURIComponent(category);
            }

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("website-list").innerHTML = data;
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchWebsites() {
            fetch("fetch_data.php")
                .then(response => response.text()) // Get response as HTML
                .then(data => {
                    document.getElementById("website-list").innerHTML = data; // Insert into container
                })
                .catch(error => console.error("Error:", error));
        }

        // Load websites when page loads
        window.onload = fetchWebsites;
        // Confirm delete function
        function confirmDelete(id, siteName, category) {
            let confirmAction = confirm(`Are you sure you want to delete "${siteName}" from category "${category}"?`);
            if (confirmAction) {
                deleteWebsite(id);
            }
        }

        // Delete function
        function deleteWebsite(id) {
            fetch("delete.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`box-${id}`).remove();
                        alert("Website deleted successfully!");
                    } else {
                        alert("Error deleting website.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }





    </script>
    <script src="script.js"></script>
    <script src="search.js"></script>
    </div>
</body>

</html>