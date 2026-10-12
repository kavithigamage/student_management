function liveSearch() {
    const search = document.getElementById("search").value.toLowerCase();
    const table = document.getElementById("tableID");
    const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr"); // Get all rows in the table body

    for (let i = 0; i < rows.length; i++) {
        const rowText = rows[i].textContent.toLowerCase(); // Get the text content of the row and convert it to lowercase

        if (rowText.includes(search)) { // Check if the row text includes the search term
            rows[i].style.display = ""; // Show the row
        } else {
            rows[i].style.display = "none";
        }
    }
}