function suggest(value) {
    // Generate a list of suggested values based on `value`
    let suggestions = ["apple","banana","citrus", "mango", "cheryy"];

    // Clear the list of suggestions
    let ul = document.getElementById("suggestions");
    ul.innerHTML = "";
    ul.style.borderBottom = "#1a7c1b solid 2px";
    // Add each suggested value to the list
    for (let suggestion of suggestions) {
        let li = document.createElement("li");
        li.innerHTML = suggestion;
        li.addEventListener("click", () => {
            // When the user clicks on a suggested value, update the input field
            document.getElementById("ziel").value = suggestion;
        });
        ul.appendChild(li);
    }
}

function suggestout() {
    // Clear the list of suggestions
    let ul = document.getElementById("suggestions");
    ul.innerHTML = "";
    ul.style.borderBottom = "transparent";
    ul.style.display = "none";
    // Add each suggested value to the list
    for (let suggestion of suggestions) {
        let li = document.createElement("li");
        li.innerHTML = suggestion;
        li.addEventListener("click", () => {
            // When the user clicks on a suggested value, update the input field
            document.getElementById("ziel").value = suggestion;
        });
        ul.style.display = "none";
    }
}