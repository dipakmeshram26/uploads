document.addEventListener('DOMContentLoaded', function () {
    // Request current page info (title, URL, description, category) from the background script
    chrome.runtime.sendMessage({ action: 'getPageInfo' }, function (response) {
        if (response) {
            document.getElementById('website-name').value = response.title;
            document.getElementById('website-url').value = response.url;

            // **Title को Description में Auto-Append करना**
            let finalDescription = response.description ? `${response.title} - ${response.description}` : response.title;
            document.getElementById('website-description').value = finalDescription;

            // अगर Category नहीं मिली तो Default 'General' रहेगी
            document.getElementById('website-category').value = response.category || "tools";
        } else {
            console.error("Error: No response received from background script.");
        }
    });

    // Form submission logic
    document.getElementById('bookmark-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const websiteName = document.getElementById('website-name').value.trim();
        const websiteUrl = document.getElementById('website-url').value.trim();
        const websiteCategory = document.getElementById('website-category').value.trim();
        const websiteDescription = document.getElementById('website-description').value.trim();

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
            category: websiteCategory,
            description: websiteDescription
        }, function (response) {
            if (response && response.success) {
                alert('Bookmark added successfully!');
            } else {
                alert('Error adding bookmark!');
            }
        });
    });
});
