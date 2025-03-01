document.addEventListener('DOMContentLoaded', function () {
    // Request current page info (title & URL) from the background script
    chrome.runtime.sendMessage({ action: 'getPageInfo' }, function (response) {
        if (response) {
            // Populate the fields with current page's title and URL
            document.getElementById('website-name').value = response.title;
            document.getElementById('website-url').value = response.url;
        } else {
            console.error("Error: No response received from background script.");
        }
    });

    // Form submission logic
    document.getElementById('bookmark-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const websiteName = document.getElementById('website-name').value;
        const websiteUrl = document.getElementById('website-url').value;
        const websiteCategory = document.getElementById('website-category').value; // Get the category value

        // Simple URL validation (basic format check)
        const urlPattern = /^(https?:\/\/)?([a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+)(:[0-9]{1,5})?(\/.*)?$/;
        if (!urlPattern.test(websiteUrl)) {
            alert('Please enter a valid URL!');
            return;
        }

        chrome.runtime.sendMessage({
            action: 'addBookmark',
            name: websiteName,
            url: websiteUrl,
            category: websiteCategory
        }, function (response) {
            if (response && response.success) {
                alert('Bookmark added successfully!');
            } else {
                alert('Error adding bookmark!');
            }
        });
    });
});
