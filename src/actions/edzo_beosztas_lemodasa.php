<?php
require_once 'sqlcall.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eid = intval($_POST['ebEID']) ?? null;
    $euid = intval($_POST['ebUID']) ?? null;
    $idopontStr = $_POST['idopont'] ?? null;
  

var_dump($eid);
var_dump($euid);
var_dump($idopontStr);

    if (!$euid || !$idopontStr || !$eid) {
        echo "<script>window.top.postMessage({loginError: 'Helytelen felhasznaló vagy időpont!'}, '*');</script>";
        exit;
    }

    // Eredeti időpont létrehozása
    $idopont = DateTime::createFromFormat('Y-m-d H:i:s', $idopontStr);
    if (!$idopont) {
        echo "<script>window.top.postMessage({loginError: 'Érvénytelen dátumformátum!'}, '*');</script>";
        exit;
    }

    // Egy nappal korábbi időpont meghatározása
    $idopont->modify('-1 day');
    $torlesiHatarido = $idopont->format('Y-m-d H:i:s');


    $most = new DateTime();

  
    if ($most > $idopont) {
        echo "<script>window.top.postMessage({loginError: 'A foglalás már nem törölhető!'}, '*');</script>";
        exit;
    }

    $sql = "UPDATE edzo_beosztas SET eb_Status = 0 WHERE ebEID = ? AND ebUID = ? AND eb_idopont = ?";
    $params = [$eid,$euid, $idopontStr];    
    $types = 'iis';
    if (sqlsave($sql, $types, $params)) {
        echo "<script>window.top.postMessage({success: 'Foglalás sikeresen törölve!'}, '*');</script>";
    } else {
        echo "<script>window.top.postMessage({loginError: 'Hiba történt az adat módosítása során.'}, '*');</script>";
    }
}
?>
