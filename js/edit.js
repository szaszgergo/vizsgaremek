var editGomb = document.getElementById("edit-btn");
editGomb.onclick = function () {
    var mentesGomb = document.getElementById("btn-save");
    mentesGomb.style.display = 'block';
    var inputok = document.querySelectorAll('input');
    inputok.forEach((input, index) => {
        //nev ne legyen editable
        if (index !== 0) {
            input.removeAttribute('disabled');
            input.removeAttribute('readonly');
            input.style.backgroundColor = '#fff';
            input.style.color = '#000';
        }
    });
}
