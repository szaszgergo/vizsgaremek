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

    // Adatbázis kapcsolat
    $db = new mysqli('localhost', 'root', '', 'regisztraciofitness');
    if ($db->connect_error) {
        die("Adatbázis kapcsolódási hiba: " . $db->connect_error);
    }

    foreach ($checkboxes as $idopont) {
        // Múltbeli időpont ellenőrzése
        if (strtotime($idopont) < strtotime(date('Y-m-d 00:00:00'))) {
            echo "<script>window.top.postMessage({loginError: 'Nem foglalhatsz múltbeli időpontot!'}, '*');</script>";
            continue; // Továbblép a következő időpontra
        }

        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM edzo_beosztas WHERE ebEID = ? AND eb_idopont = ?");
        $stmt->bind_param('is', $eid, $idopont);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            // Frissítés, ha az időpont már létezik
            $uid = $_SESSION['uid'];
            $status = 1;
            $stmtUpdate = $db->prepare("UPDATE edzo_beosztas SET ebUID = ?, eb_Status = ? WHERE ebEID = ? AND eb_idopont = ?");
            $stmtUpdate->bind_param('iiis', $uid, $status, $eid, $idopont);
            if (!$stmtUpdate->execute()) {
                echo "<script>window.top.postMessage({loginError: 'Hiba történt az adat módosítása során: {$stmtUpdate->error}'}, '*');</script>";
                exit;
            }
            echo "<script>window.top.postMessage({success: 'Foglalás sikeresen mentve!'}, '*');</script>";
            $stmtUpdate->close();
        } else {
            $newTimes[] = $idopont;
        }

        $stmt->close();
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
