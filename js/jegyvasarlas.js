

document.addEventListener('click', function (event) {
    if (event.target.matches('[data-bs-toggle="modal"]')) {
        const ticketID = event.target.closest('div').querySelector('input[name="tpID"]').value;
        document.getElementById('ftpID').value = ticketID;
        document.getElementById('ftpIDvegleges').value = ticketID;
        const ticketNev = event.target.closest('div').querySelector('h5[class="card-title"]').innerText;
        document.getElementById('jegynev').innerText = ticketNev;
        const ticketAr = event.target.closest('div').querySelector('p[class="card-text"]').innerText;
        document.getElementById('jegyar').innerText = ticketAr;

        const arak = document.querySelectorAll('td[class="price"]')
        let osszar = 0;
        arak.forEach(element => {
            console.log(element.innerText.split(" ")[0])
            osszar += parseInt(element.innerText.split(" ")[0]);
        });
        document.getElementById('osszar').innerText = `Összeg ${osszar} HUF` ;

    }
});


