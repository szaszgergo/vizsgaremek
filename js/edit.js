var editButtons = document.querySelectorAll("#edit-btn");

editButtons.forEach(editButton => {
    editButton.onclick = function () {
        var row = editButton.closest("#inputcontainer");
        var saveButton = row.querySelector("#btn-save");
        saveButton.style.display = 'block';
        editButton.style.display = 'none';

        var inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.setAttribute('data-original-value', input.value);

            input.removeAttribute('readonly');
            input.style.backgroundColor = '#fff';
            input.style.color = '#000';
        });
    }
});

var saveButtons = document.querySelectorAll("#btn-save");

saveButtons.forEach(saveButton => {
    saveButton.onclick = function () {
        var row = saveButton.closest("#inputcontainer");
        var editButton = row.querySelector("#edit-btn");
        editButton.style.display = 'block';
        saveButton.style.display = 'none';

        var inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = input.getAttribute('data-original-value');

            input.setAttribute('readonly', 'true');
            input.style.backgroundColor = "transparent";
            input.style.color = '#fff';
        });
    }
});