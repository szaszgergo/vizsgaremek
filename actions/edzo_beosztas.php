<?php
require_once 'sqlcall.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = $_POST['eid'] ?? null;
    $curdate = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d'); // Current date without time
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

    foreach ($checkboxes as $idopont) {
        // Prevent booking past dates
        if (strtotime($idopont) < strtotime($currentDate)) {
            echo "<script>window.top.postMessage({loginError: 'Nem lehet múltbeli időpontot lefoglalni!'}, '*');</script>";
            exit;
        }

        $query = "SELECT COUNT(*) AS count FROM edzo_beosztas WHERE ebEID = ? AND eb_idopont = ?";
        $result = sqlcall($query, [$eid, $idopont]);

        $resultArray = $result->fetch_assoc();
        if ($resultArray && $resultArray['count'] > 0) {
            $existingTimes[] = $idopont;
        } else {
            $newTimes[] = $idopont;
        }
    }

    if (!empty($newTimes)) {
        foreach ($newTimes as $idopont) {
            $insertQuery = "INSERT INTO edzo_beosztas (ebEID, ebUID, eb_datum, eb_idopont, eb_Status) VALUES (?, ?, ?, ?, ?)";
            $insertSuccess = sqlsave($insertQuery, [$eid, $_SESSION['uid'], $curdate, $idopont, 0]);

            if (!$insertSuccess) {
                echo "<script>window.top.postMessage({loginError: 'Hiba történt a foglalás mentése során!'}, '*');</script>";
                exit;
            }
        }
    }

    if (!empty($newTimes)) {
        echo "<script>window.top.postMessage({success: 'Foglalás sikeresen mentve!'}, '*');</script>";
    }
}
