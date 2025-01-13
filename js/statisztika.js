document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll("#all-statistics .stat-item");
    const container = document.getElementById("statistics-container");
    const controls = document.getElementById("pagination-controls");

    if (items.length === 0) return;

    const itemsPerPage = 20; 
    let currentPage = 1;

    function showItems(page) {
        container.innerHTML = "";
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        for (let i = start; i < end && i < items.length; i++) {
            container.appendChild(items[i].cloneNode(true));
        }

        updateControls(page);
    }

    function updateControls(page) {
        controls.innerHTML = "";
        const totalPages = Math.ceil(items.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "btn btn-primary mx-1";
            if (i === page) {
                button.classList.add("active");
            }
            button.addEventListener("click", () => {
                currentPage = i;
                showItems(currentPage);
            });
            controls.appendChild(button);
        }
    }

    showItems(currentPage);
});
