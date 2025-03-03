<?php
require_once 'sqlcall.php';
session_start();

if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] == "edzo") {
    echo "<script>window.top.postMessage({loginError: 'Edző nem foglalhat!'}, '*');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weekKey = $_POST['weekKey'] ?? null;
    $eid = $_POST['eid'] ?? null;
    $curdate = date('Y-m-d H:i:s');

    if (!$weekKey || !$eid) {
        echo "<script>window.top.postMessage({loginError: 'Hibás vagy hiányzó adatok!'}, '*');</script>";
        exit;
    }

    $checkboxes = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'checkboxval') === 0 && $value !== '0') {
            $checkboxes[] = $value;
        }
    }

    $existingTimes = [];
    $newTimes = [];

    foreach ($checkboxes as $idopont) {
        // Múltbeli időpont ellenőrzése
        if (strtotime($idopont) < strtotime(date('Y-m-d 00:00:00'))) {
            echo "<script>window.top.postMessage({loginError: 'Nem foglalhatsz múltbeli időpontot!'}, '*');</script>";
            continue; // Továbblép a következő időpontra
        }


        $result = sqlcall("SELECT COUNT(*) AS count FROM edzo_beosztas WHERE ebEID = ? AND eb_idopont = ?", "is", [$eid, $idopont]);
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            // Frissítés, ha az időpont már létezik
            $uid = $_SESSION['uid'];
            $status = 1;
            $result = sqlcall("UPDATE edzo_beosztas SET ebUID = ?, eb_Status = ? WHERE ebEID = ? AND eb_idopont = ?", "iiis", [$uid, $status, $eid, $idopont]);
            echo "<script>window.top.postMessage({success: 'Foglalás sikeresen mentve!'}, '*');</script>";
        } else {
            $newTimes[] = $idopont;
        }
    }

    // Ha új időpontokat kell rögzíteni
    if (!empty($newTimes)) {
        $placeholders = [];
        $params = [];
        $types = '';

        foreach ($newTimes as $idopont) {
            $placeholders[] = "(?, ?, ?, ?, ?)";
            $params[] = $eid;
            $params[] = $_SESSION['uid'];
            $params[] = $curdate;
            $params[] = $idopont;
            $params[] = 1;
            $types .= 'iissi';
        }

        $sql = "INSERT INTO edzo_beosztas (ebEID, ebUID, eb_datum, eb_idopont, eb_Status) VALUES " . implode(", ", $placeholders);
        $result = sqlsave($sql, $types, $params);

        if (!$result) {
            echo "<script>window.top.postMessage({loginError: 'Hiba történt a foglalás mentése során'}, '*');</script>";
            exit;
        }

    }

    if (!empty($newTimes)) {
        echo "<script>window.top.postMessage({success: 'Foglalás sikeresen mentve!'}, '*');</script>";
    }
}
?>
