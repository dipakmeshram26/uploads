document.addEventListener('DOMContentLoaded', function () {
    // Request current page info (title, URL, description, category) from the background script
    chrome.runtime.sendMessage({ action: 'getPageInfo' }, function (response) {
        if (response) {
            document.getElementById('website-name').value = response.title;
            document.getElementById('website-url').value = response.url;

            // **Title को Description में Auto-Append करना**
            let finalDescription = response.description ? `${response.title} - ${response.description}` : response.title;
            document.getElementById('website-description').value = finalDescription;
        } else {
            console.error("Error: No response received from background script.");
        }
    });

    // **Tag System & Category Suggestions**
    const categoryInput = document.getElementById('website-category');
    const tagContainer = document.createElement('div');
    tagContainer.classList.add('tag-container');
    categoryInput.parentNode.insertBefore(tagContainer, categoryInput.nextSibling);

    let categories = []; // Store selected categories

    // **Function to create category tags**
    function createTag(categoryName) {
        if (!categories.includes(categoryName)) {
            categories.push(categoryName);

            const tag = document.createElement('span');
            tag.classList.add('tag');
            tag.innerText = categoryName;

            const removeTag = document.createElement('span');
            removeTag.innerHTML = '&times;';
            removeTag.classList.add('remove-tag');
            removeTag.onclick = function () {
                tagContainer.removeChild(tag);
                categories = categories.filter(cat => cat !== categoryName);
            };

            tag.appendChild(removeTag);
            tagContainer.appendChild(tag);
        }
    }

    // **Comma-Separated & Backspace Tag System**
    categoryInput.addEventListener("keydown", function (event) {
        if (event.key === "," || event.key === "Enter") {
            event.preventDefault(); // Default comma और enter key behavior रोकें

            let newCategory = categoryInput.value.trim(); // Input से value लें
            if (newCategory && !categories.includes(newCategory)) {
                createTag(newCategory); // नई tag add करें
            }
            categoryInput.value = ""; // Input को खाली करें
        } else if (event.key === "Backspace" && categoryInput.value === "") {
            if (categories.length > 0) {
                let lastCategory = categories.pop(); // आखिरी category remove करें
                let lastTag = tagContainer.querySelector(`.tag:last-child`);
                if (lastTag) tagContainer.removeChild(lastTag);
            }
        }
    });

    // **Category Suggestions Fetch**
    categoryInput.addEventListener('input', function () {
        let query = categoryInput.value.trim();
        if (query.length > 0) {
            fetch('http://localhost/uploads/bookmark_extension/get_categories.php?q=' + query)
                .then(response => response.json())
                .then(data => {
                    showSuggestions(data);
                });
        }
    });

    function showSuggestions(categories) {
        let suggestionsBox = document.getElementById('category-suggestions');
        if (!suggestionsBox) {
            suggestionsBox = document.createElement('div');
            suggestionsBox.id = 'category-suggestions';
            categoryInput.parentNode.appendChild(suggestionsBox);
        }

        suggestionsBox.innerHTML = '';
        categories.forEach(category => {
            let suggestionItem = document.createElement('div');
            suggestionItem.classList.add('suggestion-item');
            suggestionItem.textContent = category;
            suggestionItem.onclick = function () {
                createTag(category);
                categoryInput.value = '';
                suggestionsBox.innerHTML = ''; // Clear suggestions after selection
            };
            suggestionsBox.appendChild(suggestionItem);
        });
    }

    // **Form Submission with Multi-Category Support**
    document.getElementById('bookmark-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const websiteName = document.getElementById('website-name').value.trim();
        const websiteUrl = document.getElementById('website-url').value.trim();
        const websiteDescription = document.getElementById('website-description').value.trim();

        if (categories.length === 0) {
            alert("Please enter at least one category!");
            return;
        }

        // **Simple URL Validation**
        const urlPattern = /^(https?:\/\/)?([a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+)(:[0-9]{1,5})?(\/.*)?$/;
        if (!urlPattern.test(websiteUrl)) {
            alert('Please enter a valid URL!');
            return;
        }

        fetch('http://localhost/uploads/bookmark_extension/add_bookmark.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: websiteName,
                url: websiteUrl,
                categories: categories, // Send multiple categories as an array
                description: websiteDescription
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Bookmark added successfully!');
                    location.reload();
                } else {
                    alert('Error adding bookmark: ' + data.error);
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                alert('Error adding bookmark! Please check the console.');
            });
    });
});
