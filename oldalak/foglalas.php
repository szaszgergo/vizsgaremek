<style>
    body {
        text-align: justify;
    }

    .row {
        font-size: 20px;
    }

    #prof_pic {
        width: 90%;
        height: 700px;
        border-radius: 20%;

    }

    #gombok {
        border-radius: 100%;
        height: 20px;
        width: 20px;
        list-style-type: none;

    }

    .carousel-control-next-icon {
        transform: translateX(-60px);
    }

    .carousel-indicators li {
        transform: translateX(-38px);
    }

    .container-fluid {
        overflow-x: unset;

    }

    body {
        overflow-x: hidden;
        margin: 0;
    }

    .komment {
        border: solid #ffcc00 3px;
        border-radius: 5px;
        width: 88%;
    }

    .comment-image {
        object-fit: cover;
        margin-right: 15px;
    }


    th,
    tr,
    td {
        border: solid 2px #ffcc00;
        margin: 10px;
        padding: 10px;
        width: 150px;
        text-align: center;

        cursor: pointer;
    }

    td,
    th {
        border: solid 2px black;
    }

    #tablazat th,
    #tablazat td:first-child {
        border-color: #ffcc00;
    }

    .fotablazat {
        padding: 10px;
        text-align: center;
    }

    .checkbox-cell {
        background-color: darkgrey;

    }

    .checkbox-cell.checked {
        background-color: lightgreen !important;
    }

    .checkbox-cell.loaded {
        background-color: red !important;
        pointer-events: none;
        /* Betöltött cellák nem szerkeszthetők */
    }

    .checkbox-cell.loadededzo {
        background-color: lightgreen !important;
    }

    input[type="checkbox"] {
        display: none;
    }

    .week-controls {
        text-align: center;
        margin-top: 20px;
    }

    .week-controls button {
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        background-color: #ffcc00;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .week-controls button:hover {
        background-color: #e6b800;
    }

    .week-title {
        font-size: 18px;
        font-weight: bold;
        margin: 0px;
    }




    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    /* A popup doboz */
    .popup-content {
        width: 90%;
        max-width: 500px;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        font-size: 1.2rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        background-color: white;
        position: relative;
        transform: translate(0%, 20%);
    }

    /* Popup gombok */
    .popup-buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }

    .popup-buttons button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 5px;

    }

    .popup-buttons .save {
        background-color: green;
        color: white;
    }

    .popup-buttons .cancel {
        background-color: red;
        color: white;
    }

    .static-gray {
        background-color: darkgrey;
        pointer-events: none;
        /* Letiltjuk a kattintási eseményeket */
    }

    .fotablazat {
        width: 100% !important;
        display: flex;
        justify-content: center;
    }

    @media screen and (max-width: 768px) {
         .fotablazat th, td, tr {     
         padding: 0 !important;
         margin: 0 !important;
         font-size: 0.7rem;
         }
         .row {
            width: 100% !important;
            margin: auto !important;
            padding: 0 !important;
        }  
         .container-fluid {
            padding: 0 !important;
        }
        .week-controls button {
            padding: 5px !important;
            margin: 0 !important;
        }
        .week-controls {
            margin-bottom: 10px !important;
        }
     }
</style>

<?php
require_once 'dialog.php';
?>
<script src="js/success_error.js" defer></script>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 bg-transparentblack">
            <h2>Időpont foglalás</h2>
            <h5>GMT+01:00</h5>
            <div class="week-controls">
                <button style="margin-left:40px;" id="prevWeek">Előző hét</button>
                <span id="currentWeek" class="week-title"></span>
                <button id="nextWeek">Következő hét</button>
                <form action="./actions/foglalas_mentes.php" target="kisablak" method="POST">
                    <input type="hidden" name="weekKey" id="weekKey">
                    <div id="checkboxes-container"></div> <!-- Ide kerülnek a checkboxok -->
                    <input type="hidden" name="eid" value="<?php print_r($_GET['eid'])  ?>">
                    <button id="idomentes">Mentés</button>


                </form>
            </div>
            <div class="fotablazat">
                <table id="tablazat">
                    <tr>
                        <th>Idő</th>
                        <th>Hétfő</th>
                        <th>Kedd</th>
                        <th>Szerda</th>
                        <th>Csütörtök</th>
                        <th>Péntek</th>
                        <th>Szombat</th>
                        <th>Vasárnap</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    const Adatok = [];
    let startHour = 6;
    let endHour = 23;

    // Hozzáadjuk az aktuális évet
    const currentYear = new Date().getFullYear();

    for (let hour = startHour; hour < endHour; hour++) {
        const hourString = hour < 10 ? `0${hour}` : `${hour}`;
        const startTime = `${hourString}:00:00`;
        const endTime = `${hour + 1 < 10 ? '0' + (hour + 1) : hour + 1}:00:00`;
        const timeRange = `${startTime}`;

        Adatok.push({
            ido: timeRange,
            hetfo: "",
            kedd: "",
            szerda: "",
            csutortok: "",
            pentek: "",
            szombat: "",
            vasarnap: ""
        });
    }

    let currentWeekStart = getMonday(new Date());

    window.onload = () => {
        renderTable(Adatok, currentWeekStart);
        updateWeekDisplay();
        loadCheckboxes(); // Betölteni az elmentett állapotokat
    };

    document.getElementById('prevWeek').onclick = () => {
        currentWeekStart.setDate(currentWeekStart.getDate() - 7);
        renderTable(Adatok, currentWeekStart);
        updateWeekDisplay();
        loadCheckboxes(); // Betöltés hétváltáskor
    };

    document.getElementById('nextWeek').onclick = () => {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        renderTable(Adatok, currentWeekStart);
        updateWeekDisplay();
        loadCheckboxes(); // Betöltés hétváltáskor
    };

    function getMonday(date) {
        const day = date.getDay();
        const diff = date.getDate() - day + (day === 0 ? -6 : 1); // Monday is the first day
        return new Date(date.setDate(diff));
    }

    function updateWeekDisplay() {
        const start = new Date(currentWeekStart);
        const end = new Date(start);
        end.setDate(start.getDate() + 6);

        const options = {
            month: '2-digit',
            day: '2-digit'
        };

        document.getElementById('currentWeek').textContent =
            `${start.toLocaleDateString('hu-HU', options)} - ${end.toLocaleDateString('hu-HU', options)}`;

        // Beállítjuk a weekKey értékét
        document.getElementById('weekKey').value = getWeekKey(start);

        const weekdays = ['hetfo', 'kedd', 'szerda', 'csutortok', 'pentek', 'szombat', 'vasarnap'];
        weekdays.forEach((day, i) => {
            const date = new Date(currentWeekStart);
            date.setDate(currentWeekStart.getDate() + i);
            const dayCell = document.querySelector(`th:nth-child(${i + 2})`);
            dayCell.textContent = `${day.charAt(0).toUpperCase() + day.slice(1)}\n${date.toLocaleDateString('hu-HU', options)}`;
        });
    }

    function renderTable(data, weekStart) {
        const table = document.getElementById("tablazat");
        table.querySelectorAll("tr:not(:first-child)").forEach(row => row.remove());

        data.forEach((row, rowIndex) => {
            let tr = document.createElement('tr');

            for (const key in row) {
                if (key === "ido") {
                    addTD(tr, row[key]);
                } else {
                    addInteractiveCell(tr, key, rowIndex, weekStart);
                }
            }

            table.appendChild(tr);
        });
    }

    function addTD(parent, szoveg) {
        let td = document.createElement("td");
        td.textContent = szoveg;
        parent.appendChild(td);
    }

    function addInteractiveCell(parent, day, rowIndex, weekStart) {

        let td = document.createElement("td");
        td.classList.add("checkbox-cell");

        let checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.classList.add("checkbox");

        const dayDate = new Date(weekStart);
        dayDate.setDate(weekStart.getDate() + ["hetfo", "kedd", "szerda", "csutortok", "pentek", "szombat", "vasarnap"].indexOf(day));
        const dateStr = `${currentYear}-${(dayDate.getMonth() + 1).toString().padStart(2, '0')}-${dayDate.getDate().toString().padStart(2, '0')}`;
        const timeRange = Adatok[rowIndex].ido;
        checkbox.value = `${dateStr} ${timeRange}`;
        td.classList.add("static-gray");

        td.addEventListener("click", function() {
            showPopup(td, td);
        });

        td.addEventListener("click", function() {
            if (td.classList.contains("loaded")) {
                // Ha betöltött cella (piros), ne csináljon semmit
                return;
            } else if (td.classList.contains("loadededzo")) {
                // Ha zöld cella, válts pirosra
                td.style.pointerEvents = "auto";
                td.classList.remove("loadededzo");
                td.classList.remove("loadededzo");

                td.classList.add("checked");
                td.style.backgroundColor = "red";
            } else if (td.classList.contains("checked")) {
                // Ha már piros cella, akkor állítsd vissza zöldre
                td.classList.remove("checked");
                td.classList.add("loadededzo");
                td.style.backgroundColor = "lightgreen";
            } else {
                // Ha egyik állapotban sincs, váljon zölddé
                td.classList.add("loadededzo");
                td.style.backgroundColor = "lightgreen";
            }
        });


        td.appendChild(checkbox);
        parent.appendChild(td);
    }

    function onConfirm() {

    }

    function closePopup() {
        const popup = document.getElementById("customPopup");
        if (popup) popup.remove();
    }

    function showPopup(message, cell, onConfirm) {
        // Ha már van popup, ne hozzunk létre újat
        if (document.getElementById("customPopup")) return;

        // Létrehozunk egy háttér elemet
        const overlay = document.createElement("div");
        overlay.classList.add("popup-overlay");
        overlay.id = "customPopup";

        // Létrehozzuk a popup tartalmát
        const popupContent = document.createElement("div");
        popupContent.classList.add("popup-content");
        const weekKeyValue = document.getElementById("weekKey").value;






        popupContent.innerHTML = `



 <form action="./actions/foglalas_mentes.php" target="kisablak" method="POST">
                        <input type="hidden" name="weekKey" id="weekKey" value="${weekKeyValue}">
                        <input type="hidden" name="checkboxval" id="checkboxval" value="${cell.children[0].value}">
                        <div id="checkboxes-container"></div> <!-- Ide kerülnek a checkboxok -->
                        <input type="hidden" name="eid" value="<?php print_r($_GET['eid'])  ?>">

                  


                        <p>Menteni Szeretnéd az időpontot?</p>
                        <div class="popup-buttons">
                            <button class="idomentes save">Mentés</button>
                            <button class="cancel">Mégse</button>
                        </div>
                        </form>

    `;

        // Hozzáadjuk az elemeket a dokumentumhoz
        overlay.appendChild(popupContent);
        document.body.appendChild(overlay);

        // Hozzáadjuk az eseménykezelőket
        /*    popupContent.querySelector(".save").addEventListener("click", () => {
               setTimeout(closePopup, 1);
           }); */

        popupContent.querySelector(".cancel").addEventListener("click", closePopup);
    }

    // Példa használatra egy cellára kattintáskor:
    document.querySelectorAll(".checkbox-cell").forEach(cell => {
        cell.addEventListener("click", function() {
            // console.log(cell);
            showPopup("Szeretnéd menteni ezt az időpontot?", cell.children[0], () => {
                cell.classList.add("checked");
                cell.style.backgroundColor = "red";
            });
        });
    });



    document.getElementById('idomentes').addEventListener('click', function(event) {
        saveCheckboxes();
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.checkbox-cell').forEach(checkbox => {
            checkbox.addEventListener('change', saveCheckboxes);
        });
    });

    function saveCheckboxes() {

        const checkboxes = document.querySelectorAll('.checkbox-cell.checked:not(:checked) input[type="checkbox"]'); // Csak a bejelölteket vesszük
        const container = document.getElementById('checkboxes-container');
        container.innerHTML = ''; // Töröljük az előző hidden inputokat

        checkboxes.forEach((checkbox, index) => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `checkbox-${index}`;
            hiddenInput.value = checkbox.value;
            container.appendChild(hiddenInput);
        });

        //   console.log("Mentett időpontok:", [...checkboxes].map(cb => cb.value));
    }




    function getWeekKey(weekStartDate) {
        return weekStartDate.toISOString().split('T')[0]; // A hét kezdő dátumát ISO formátumban visszaadja
    }

    function loadCheckboxes() {
        const urlParams = new URLSearchParams(window.location.search);
        const eid = urlParams.get('eid');

        fetch(`actions/get_edzo_beosztas.php?eid=${eid}`)
            .then(response => response.json())
            .then(data => {
                //    console.log(data); // A teljes JSON tartalom megjelenítése a konzolon

                // Az adatokat objektumokká alakítjuk, hogy könnyebb legyen dolgozni velük
                const parsedData = data.map(item => {
                    const parts = item.split(' '); // Split string by space
                    return {
                        date: parts[0], // Dátum
                        time: parts[1], // Idő
                        status: parseInt(parts[2]) // Státusz
                    };
                });

                //  console.log(parsedData); // A feldolgozott adatok kiírása a konzolra

                const checkboxes = document.querySelectorAll('.checkbox');
                checkboxes.forEach(checkbox => {
                    const item = parsedData.find(parsedItem => {
                        // Ellenőrizzük, hogy az adott időpont azonos-e a checkbox értékével
                        return `${parsedItem.date} ${parsedItem.time}` === checkbox.value;
                    });

                    if (item) {
                        //     console.log(`Dátum: ${item.date}, Idő: ${item.time}, Státusz: ${item.status}`); // Debugging log

                        const status = item.status;
                        const parentCell = checkbox.parentElement;

                        // Háttérszín beállítása az állapot alapján
                        if (status === 0) {
                            parentCell.classList.remove("static-gray"); // Ha betöltődik, töröljük a szürke osztályt
                            parentCell.style.backgroundColor = 'lightgreen';
                        } else if (status === 1) {
                            parentCell.classList.remove("static-gray");
                            parentCell.style.backgroundColor = 'red';
                            parentCell.style.pointerEvents = 'none';
                        }

                        // Checkbox bejelölése, ha nincs bejelölve
                        if (!checkbox.checked) {
                            checkbox.checked = true;
                        }
                    }
                });

            })
            .catch(error => console.error('Hiba történt az edző beosztás betöltésekor:', error));
    }
</script>