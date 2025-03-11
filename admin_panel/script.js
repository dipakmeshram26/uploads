

// Get the popup and buttons
const loginBtn = document.getElementById('loginBtn');
const loginPopup = document.getElementById('loginPopup'); // Using ID
const closeBtn = document.querySelector('.close-btn');

// Open the popup when the Admin Login button is clicked
loginBtn.addEventListener('click', () => {
    loginPopup.style.display = 'block';
});

// Close the popup when the close button (×) is clicked
function closePopup() {
    loginPopup.style.display = 'none';
}

// Close the popup if the user clicks outside of the popup content
window.addEventListener('click', (e) => {
    if (e.target === loginPopup) {
        loginPopup.style.display = 'none';
    }
});

// Handle form submission for login
document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission (page reload)

    // Get the entered username and password
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    // Send the login data to the server using the fetch API (AJAX)
    fetch("admin_auth.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `username=${username}&password=${password}`
    })
        .then(response => response.json()) // Parse the JSON response from the server
        .then(data => {
            if (data.success) {
                // If login is successful, redirect to the admin dashboard
                window.location.href = "admin_dashboard.php";
            } else {
                // If login fails, display an error message
                document.getElementById("loginMessage").textContent = "Invalid Username or Password!";
            }
        })
        .catch(error => {
            // Handle any errors that occur during the fetch request
            console.error("Error during login:", error);
        });
});



document.addEventListener("DOMContentLoaded", function () {
    var openFormBtn = document.getElementById("openFormBtn");
    var popupForm = document.getElementById("popupForm");
    var closeFormBtn = document.getElementById("closeFormBtn");
    var closeButton = document.querySelector(".close-btn");

    // Open Form on Button Click
    openFormBtn.addEventListener("click", function () {
        popupForm.style.display = "flex";
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

function toggleVisibility(id) {
    fetch('toggle_visibility.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + id
    })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                location.reload(); // Refresh to update status
            } else {
                alert("Failed to update visibility.");
            }
        })
        .catch(error => console.error('Error:', error));
}


// Open the Edit form and populate it with the data
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

