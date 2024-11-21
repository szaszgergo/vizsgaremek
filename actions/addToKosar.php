<?php
session_start();
require("sqlcall.php");

$teid = $_POST["teID"]; 
$uid = $_SESSION["uid"]; 

$kosarlekeres = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL");
$kosar = $kosarlekeres->fetch_assoc();

if (!$kosar) {
    sqlsave("INSERT INTO kosar (koUID, koTranzakcioID) VALUES ($uid, NULL)");

    $kosarlekeres = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL");
    $kosar = $kosarlekeres->fetch_assoc();
}

$koID = $kosar["koID"];

sqlsave("INSERT INTO kosar_tetelek (ktkoID, ktTipus, ktBeazonosito, ktMennyiseg) VALUES ($koID, 'TERMEK', $teid, 1)");

echo "<alert>Termék sikeresen hozzáadva a kosárhoz!</alert>";
?>
