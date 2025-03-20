document.addEventListener("DOMContentLoaded", function () {
    const categoryInput = document.getElementById("website-category");
    const tagContainer = document.createElement("div");
    tagContainer.classList.add("tag-container");
    categoryInput.parentNode.insertBefore(tagContainer, categoryInput);

    let categories = [];

    categoryInput.addEventListener("keydown", function (event) {
        if (event.key === "," || event.key === "Enter") {
            event.preventDefault();
            let category = categoryInput.value.trim().replace(/,/g, "");

            if (category && !categories.includes(category)) {
                categories.push(category);
                addTag(category);
            }
            categoryInput.value = "";
        }
    });

    function addTag(text) {
        let tag = document.createElement("span");
        tag.classList.add("tag");
        tag.innerHTML = `${text} <button type="button" class="remove-tag">&times;</button>`;

        tag.querySelector(".remove-tag").addEventListener("click", function () {
            tag.remove();
            categories = categories.filter(cat => cat !== text);
        });

        tagContainer.appendChild(tag);
    }

    // Final category values backend ko send karne ke liye
    document.getElementById("bookmark-form").addEventListener("submit", function () {
        categoryInput.value = categories.join(", ");
    });
});
