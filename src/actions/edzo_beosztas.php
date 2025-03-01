<?php
require_once 'sqlcall.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = $_POST['eid'] ?? null;
    $curdate = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d'); // Az aktuális dátum idő nélkül
    $checkboxval = $_POST['checkboxval'];

    var_dump($eid);
    var_dump($curdate);
    var_dump($checkboxval);

    if (!isset($eid)) {
        echo "<script>window.top.postMessage({loginError: 'Hibás vagy hiányzó adatok!'}, '*');</script>";
        exit;
    }

    $checkboxes = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'checkboxval') === 0 && $value !== '0') {
            $checkboxes[] = $value;
            var_dump($checkboxes);
        }
    }

    $existingTimes = [];
    $newTimes = [];

    // Adatbázis kapcsolat
    $db = new mysqli('localhost', 'root', '', 'regisztraciofitness');
    if ($db->connect_error) {
        die("Adatbázis kapcsolódási hiba: " . $db->connect_error);
    }

    foreach ($checkboxes as $idopont) {
        // Múltbeli dátum ellenőrzése
        if (strtotime($idopont) < strtotime($currentDate)) {
            echo "<script>window.top.postMessage({loginError: 'Nem lehet múltbeli időpontot lefoglalni!'}, '*');</script>";
            exit;
        }

        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM edzo_beosztas WHERE ebEID = ? AND eb_idopont = ?");
        $stmt->bind_param('is', $eid, $idopont);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $existingTimes[] = $idopont;
        } else {
            $newTimes[] = $idopont;
        }

        $stmt->close();
    }

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
            $params[] = 0;
            $types .= 'iissi';
        }

        $sql = "INSERT INTO edzo_beosztas (ebEID, ebUID, eb_datum, eb_idopont, eb_Status) VALUES " . implode(", ", $placeholders);
        $stmt = $db->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if (!$stmt->execute()) {
            echo "<script>window.top.postMessage({loginError: 'Hiba történt a foglalás mentése során: {$stmt->error}'}, '*');</script>";
            exit;
        }

        $stmt->close();
    }

    $db->close();

    if (!empty($newTimes)) {
        echo "<script>window.top.postMessage({success: 'Foglalás sikeresen mentve!'}, '*');</script>";
    }
}
?>
