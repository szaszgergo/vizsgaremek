document.addEventListener("DOMContentLoaded", function() {
    const comments = document.querySelectorAll("#all-comments .comment");
    const container = document.getElementById("comments-container");
    const controls = document.getElementById("pagination-controls");

    const commentsPerPage = 20;
    let currentPage = 1;

    function showComments(page) {
        container.innerHTML = "";
        const start = (page - 1) * commentsPerPage;
        const end = start + commentsPerPage;

        for (let i = start; i < end && i < comments.length; i++) {
            container.appendChild(comments[i].cloneNode(true));
        }

        updateControls(page);
    }

    function updateControls(page) {
        controls.innerHTML = ""; 
        const totalPages = Math.ceil(comments.length / commentsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "btn btn-primary mx-1";
            if (i === page) {
                button.classList.add("active");
            }
            button.addEventListener("click", () => {
                currentPage = i;
                showComments(currentPage);
            });
            controls.appendChild(button);
        }
    }

    showComments(currentPage);
});