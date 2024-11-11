var editButtons = document.querySelectorAll("#edit-btn");

editButtons.forEach(editButton => {
    editButton.onclick = function () {
        var row = editButton.closest("#inputcontainer");
        var saveButton = row.querySelector("#btn-save");
        saveButton.style.display = 'block';
        editButton.style.display = 'none';

        var inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.removeAttribute('readonly');
            input.style.backgroundColor = '#fff';
            input.style.color = '#000';
        });
    }
});