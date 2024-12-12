<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hétválasztó Táblázat</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .row {
            grid-template-columns: 1fr 1fr;
            min-height: 85vh;
        }

        .col {
            padding: 20px;
        }

        .col-right {
            background-color: #ffe4b5;
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
            margin: 100px;
            margin-left: 120px;
            padding: 10px;
            text-align: center;
        }

        .checkbox-cell {
            background-color: lightgreen;
        }

        .checkbox-cell.checked {
            background-color: red;
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
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-transparentblack">
                <h2>Jelentkezés</h2>
                <h5>GMT+01:00</h5>
                <div class="week-controls">
                    <button id="prevWeek">Előző hét</button>
                    <span id="currentWeek" class="week-title"></span>
                    <button id="nextWeek">Következő hét</button>
                    <form action="./actions/foglalas_save.php" target="kisablak" method="POST">
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
        const Adatok = [];
        let startHour = 6;
        let endHour = 23;

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minute = 0; minute < 60; minute += 30) {
                if (hour === endHour && minute > 0) break;

                const timeString = `${hour}:${minute.toString().padStart(2, '0')}`;
                Adatok.push({
                    ido: timeString,
                    hetfo: "",
                    kedd: "",
                    szerda: "",
                    csutortok: "",
                    pentek: "",
                    szombat: "",
                    vasarnap: ""
                });
            }
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
        }

        function renderTable(data, weekStart) {
            const table = document.getElementById("tablazat");
            table.querySelectorAll("tr:not(:first-child)").forEach(row => row.remove());

            data.forEach(row => {
                let tr = document.createElement('tr');

                for (const key in row) {
                    if (key === "ido") {
                        addTD(tr, row[key]);
                    } else {
                        addInteractiveCell(tr, key);
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

        function addInteractiveCell(parent, day) {
            let td = document.createElement("td");
            td.classList.add("checkbox-cell");

            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.classList.add("checkbox");
            checkbox.value = 30;  // Minden checkbox értéke 30

            td.addEventListener("click", function() {
                checkbox.checked = !checkbox.checked;
                td.classList.toggle("checked", checkbox.checked);
            });

            td.appendChild(checkbox);
            parent.appendChild(td);
        }

        document.getElementById('idomentes').addEventListener('click', function() {
            saveCheckboxes(); // Mentés gomb megnyomása után
        });

        function saveCheckboxes() {
            const checkboxes = document.querySelectorAll('.checkbox');
            const weekKey = getWeekKey(currentWeekStart); // Egyedi hétkulcs generálása

            // Hozzáadjuk a hétkulcsot a formhoz
            document.getElementById('weekKey').value = weekKey;

            // Hozzáadjuk a checkboxok értékét rejtett input mezőként a formhoz
            const container = document.getElementById('checkboxes-container');
            container.innerHTML = ''; // Előző adatokat töröljük

            checkboxes.forEach((checkbox, index) => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `checkbox-${index}`;
                hiddenInput.value = checkbox.checked ? checkbox.value : 0;
                container.appendChild(hiddenInput);
            });
        }

        function getWeekKey(weekStartDate) {
            return weekStartDate.toISOString().split('T')[0]; // A hét kezdő dátumát ISO formátumban visszaadja
        }

        function loadCheckboxes() {
            // Betöltjük az elmentett checkboxokat (ezt a PHP fogja kezelni, amikor az adatokat visszaküldjük)
        }
    </script>
</body>

</html>
