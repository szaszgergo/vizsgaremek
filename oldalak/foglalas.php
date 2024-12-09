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

            cursor: pointer; 
        }
td, th {
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

        document.querySelector('body').onload = () => addTR(Adatok);

        function addTR(arr) {
            arr.forEach(row => {
                let tr = document.createElement('tr');

                for (const key in row) {
                    if (key === "ido") {
                        addTD(tr, row[key]); 

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

            td.addEventListener("click", function () {
                checkbox.checked = !checkbox.checked; 
                if (checkbox.checked) {
                    td.classList.add("checked"); 
                } else {
                    td.classList.remove("checked"); 
                }
            });

            td.appendChild(checkbox); 
            parent.appendChild(td);
        }
    </script>
</body>
</html>
