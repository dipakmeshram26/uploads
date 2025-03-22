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
        <!-- <link rel="stylesheet" href="../styles.css"> -->
    </div>
    <!-- <h2>Sub-Admin <span class="red">Panel</span></h2> -->
    <ul class="nav-links">
        <li><a href=" dashboard_subadmin.php">Dashboard</a></li>
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
               <div class="redio-btns"> 
                    <label>Visibility:</label>
                    <input type="radio" name="visibility" value="public" onclick="changeVisibility()" checked> Public
                    <input type="radio" name="visibility" value="private" onclick="changeVisibility()"> Private
                     </div>

                <div id="sub-clos">
                    <button type="submit" class="submit">Submit</button>
                    <button type="button" id="closeFormBtn">x</button>
                </div>
            </form>
        </div>
    </div>

  <div class="display-container">
    <h2>Websites</h2>
    <div id="website-list"></div> <!-- Websites display container -->
</div>

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

    document.addEventListener("DOMContentLoaded", function() {
    fetchWebsites();
});

function fetchWebsites() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_data.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("website-list").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// site delele buton work 
// site delele buton work 
// site delele buton work  

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
                        // console.log("Response from delete.php:", data); // 🛠️ Debugging Response

                        if (data.status === "success") {
                            alert(data.message);
                            document.getElementById("website-" + id).remove(); // UI से Remove करें
                        } else {
                            alert("Error: " + data.message);
                        }
                        location.reload();
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

        function openEditForm(id) {
    // Fetch data from the server for the selected website
    fetch('get_website_data.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            // Populate the form fields with the data
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_site_name').value = data.site_name;
            document.getElementById('edit_description').value = data.description;
            document.getElementById('edit_site_link').value = data.site_link;
            document.getElementById('edit_category').value = data.category;

            // Set the visibility radio buttons based on the value
            if (data.visibility === 'public') {
                document.getElementById('public').checked = true;
            } else {
                document.getElementById('private').checked = true;
            }

            // Show the form
            document.getElementById('editPopupForm').style.display = 'block';
        });
}

// Close the Edit form
function closeEditForm() {
    document.getElementById('editPopupForm').style.display = 'none';
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

</body>
</html>

<?php
$conn->close();
?>
