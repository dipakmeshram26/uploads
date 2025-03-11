

function toggleMenu() {
    let navLinks = document.querySelector(".nav-links");
    let openIcon = document.querySelector(".hamburger .open");
    let closeIcon = document.querySelector(".hamburger .close");


    navLinks.classList.toggle("open-menu");



    if (navLinks.classList.contains("open-menu")) {
        openIcon.style.display = "none";  // Hide ☰
        closeIcon.style.display = "block"; // Show ✖


    } else {
        openIcon.style.display = "block";  // Show ☰
        closeIcon.style.display = "none"; // Hide ✖
    }
}


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

