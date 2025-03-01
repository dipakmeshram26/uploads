// Fetch the title and URL of the current webpage
let pageTitle = document.title;
let pageUrl = window.location.href;

// Send this data to the background.js
chrome.runtime.onMessage.addListener(function (request, sender, sendResponse) {
    if (request.action === 'getPageInfo') {
        sendResponse({ title: pageTitle, url: pageUrl });
    }
});
