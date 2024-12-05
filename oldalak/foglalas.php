<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Táblázat Cellák Kijelölése</title>
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

            cursor: pointer; /* Mutatja, hogy kattintható */
        }
   /* Minden cella fekete szegéllyel */
td, th {
    border: solid 2px black;
}

/* Első oszlop ("Idő") és az első sor ("Napok") sárga szegéllyel */
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
            background-color: red; /* Zöld szín a kijelölt celláknak */
        }

        input[type="checkbox"] {
            display: none; /* Checkbox elrejtése */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-transparentblack">
                <h2>Jelentkezés</h2>
                <h5>GMT+01:00</h5>
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
        // 1. Dinamikus JSON generálás
        const Adatok = [];
        let startHour = 6; // Kezdő óra
        let endHour = 23;  // Végző óra

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

        // 2. Táblázat kitöltése
        document.querySelector('body').onload = () => addTR(Adatok);

        function addTR(arr) {
            arr.forEach(row => {
                let tr = document.createElement('tr');

                // Minden oszlop érték bejárása
                for (const key in row) {
                    if (key === "ido") {
                        addTD(tr, row[key]); // Idő oszlop szöveges

                    } else {
                        addInteractiveCell(tr);
                    }
                }

                document.getElementById("tablazat").appendChild(tr);
            });
        }

        function addTD(parent, szoveg) {
            let td = document.createElement("td");
            td.textContent = szoveg;
            parent.appendChild(td);
        }

        function addInteractiveCell(parent) {
            let td = document.createElement("td");
            td.classList.add("checkbox-cell");

            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";

            // Kattintásra váltás
            td.addEventListener("click", function () {
                checkbox.checked = !checkbox.checked; // Állapot váltása
                if (checkbox.checked) {
                    td.classList.add("checked"); // Zöld szín
                } else {
                    td.classList.remove("checked"); // Fehér szín
                }
            });

            td.appendChild(checkbox); // Checkbox rejtve, de működik
            parent.appendChild(td);
        }
    </script>
</body>
</html>
