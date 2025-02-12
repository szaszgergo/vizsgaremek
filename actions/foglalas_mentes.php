<?php
require_once 'sqlcall.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weekKey = $_POST['weekKey'] ?? null;
    $eid = $_POST['eid'] ?? null;
    $curdate = date('Y-m-d H:i:s');

    if (!$weekKey || !$eid) {
        die('Hibás vagy hiányzó adatok!');
    }

    $checkboxes = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'checkbox-') === 0 && $value !== '0') {
            $checkboxes[] = $value; // Mentjük a kiválasztott időpontokat
        }
    }

    if (count($checkboxes) > 0) {
        $existingTimes = [];
        $newTimes = [];

        // Ellenőrzés: meglévő foglalások lekérdezése
        $db = new mysqli('localhost', 'root', '', 'regisztraciofitness');
        if ($db->connect_error) {
            die("Adatbázis kapcsolódási hiba: " . $db->connect_error);
        }

        foreach ($checkboxes as $idopont) {
            $stmt = $db->prepare("SELECT COUNT(*) AS count FROM edzok_foglalas WHERE foEID = ?  AND fo_idopont = ?");
            $stmt->bind_param('is', $eid, $idopont);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $existingTimes[] = $idopont; // Már meglévő foglalások
            } else {
                $newTimes[] = $idopont; // Új időpontok
            }

            $stmt->close();
        }

        // Csak az új időpontokat szúrjuk be
        if (count($newTimes) > 0) {
            $placeholders = [];
            $params = [];
            $types = '';

            foreach ($newTimes as $idopont) {
                $placeholders[] = "(?, ?, ?, ?)";
                $params[] = $eid;
                $params[] = $_SESSION['uid'];
                $params[] = $curdate;
                $params[] = $idopont;
                $types .= 'iiss';
            }

            $sql = "INSERT INTO edzok_foglalas (foEID, foUID, fo_datum, fo_idopont) VALUES " . implode(", ", $placeholders);
            $stmt = $db->prepare($sql);
            $stmt->bind_param($types, ...$params);

            if (!$stmt->execute()) {
                die('Hiba történt a foglalás mentése során: ' . $stmt->error);
            }

            $stmt->close();
        }

        $db->close();

        if (!empty($existingTimes)) {
            echo 'Az alábbi időpontokat már lefoglalták: ' . implode(', ', $existingTimes);
        }

        // POST kérés után átirányítjuk a felhasználót egy új GET kérésre, hogy a böngésző ne küldje el újra a POST adatokat.
        header("Location: " . $_SERVER['PHP_SELF']); // Az oldal újratöltése GET módban
        exit; // Megakadályozza a további kód futtatását
    } else {
        die('Nincsenek kiválasztott időpontok vagy már mind foglaltak!');
    }
}
?>
