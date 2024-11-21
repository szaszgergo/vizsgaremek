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
$termeklekeres = sqlcall("SELECT ktMennyiseg FROM kosar_Tetelek WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");

if ($termek = $termeklekeres->fetch_assoc()) {
    $ujMennyiseg = $termek['ktMennyiseg'] + 1;
    sqlsave("UPDATE kosar_Tetelek SET ktMennyiseg = $ujMennyiseg WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");
} else {
    sqlsave("INSERT INTO kosar_Tetelek (ktkoID, ktTipus, ktBeazonosito, ktMennyiseg) VALUES ($koID, 'TERMEK', $teid, 1)");
}
echo "<alert>Termék sikeresen hozzáadva a kosárhoz!</alert>";
?>
