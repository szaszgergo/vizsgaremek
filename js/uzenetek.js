document.addEventListener("DOMContentLoaded", function() {
    const messages = document.querySelectorAll("#all-messages .message");
    const container = document.getElementById("messages-container");
    const controls = document.getElementById("pagination-controls");

    const messagesPerPage = 10;
    let currentPage = 1;

    function showMessages(page) {
        container.innerHTML = "";
        const start = (page - 1) * messagesPerPage;
        const end = start + messagesPerPage;

        for (let i = start; i < end && i < messages.length; i++) {
            container.appendChild(messages[i].cloneNode(true));
        }

        updateControls(page);
    }

    function updateControls(page) {
        controls.innerHTML = "";
        const totalPages = Math.ceil(messages.length / messagesPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "btn btn-primary mx-1";
            if (i === page) {
                button.classList.add("active");
            }
            button.addEventListener("click", () => {
                currentPage = i;
                showMessages(currentPage);
            });
            controls.appendChild(button);
        }
    }

    showMessages(currentPage);
});