chrome.runtime.onMessage.addListener(function (request, sender, sendResponse) {
    // Action to get the current page's title and URL
    if (request.action === 'getPageInfo') {
        chrome.tabs.query({ active: true, currentWindow: true }, function (tabs) {
            let activeTab = tabs[0];
            sendResponse({ title: activeTab.title, url: activeTab.url });
        });
        return true;  // Required for async response
    }

    // Action to add the bookmark to the database
    if (request.action === 'addBookmark') {
        // Get the category from the request
        const category = request.category || "Uncategorized";

        // Ensure the response is not sent until fetch completes
        fetch('http://localhost/uploads/bookmark_extension/add_bookmark.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `name=${request.name}&url=${request.url}&category=${category}`  // Include category in the body
        })
            .then(response => response.json())
            .then(data => {
                console.log('Response from PHP:', data);  // Log the response for debugging
                if (data.success) {
                    sendResponse({ success: true });
                } else {
                    sendResponse({ success: false, error: data.error });
                }
            })
            .catch(error => {
                console.log('Error in fetch:', error);  // Log any fetch-related error
                sendResponse({ success: false, error: 'Network Error' });
            });

        return true; // Keep the message port open while the fetch request completes
    }
});
