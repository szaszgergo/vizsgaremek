<div class="modal fade" id="ujedzo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">Edző felvétele</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                <!-- Search Form -->
                <form onsubmit="searchUsers(event)">
                    <div class="mb-3">
                        <input 
                            type="text" 
                            id="searchUser" 
                            class="form-control" 
                            placeholder="Keresés felhasználónév alapján"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Keresés</button>
                </form>

                <!-- Search Results -->
                <div id="userResults" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
function searchUsers(event) {
    event.preventDefault(); // Prevent page refresh
    const searchQuery = document.getElementById("searchUser").value;
    const resultsDiv = document.getElementById("userResults");

    fetch("./actions/admin/kereses.php?searchUser=" + encodeURIComponent(searchQuery))
        .then(response => response.text())
        .then(data => {
            resultsDiv.innerHTML = data;
        })
        .catch(error => {
            console.error("Error fetching search results:", error);
            resultsDiv.innerHTML = "<div class='alert alert-danger'>Hiba történt a keresés során.</div>";
        });
}
</script>
