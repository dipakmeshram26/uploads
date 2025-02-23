document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const searchResults = document.getElementById("search-results");

    searchInput.addEventListener("keyup", function () {
        let query = searchInput.value.trim();

        if (query.length > 1) {
            fetch("search.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "query=" + encodeURIComponent(query),
            })
                .then(response => response.text())
                .then(data => {
                    searchResults.innerHTML = data;
                })
                .catch(error => console.error("Error:", error));
        } else {
            searchResults.innerHTML = "";
        }
    });
});
