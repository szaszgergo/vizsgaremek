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
$termeklekeres = sqlcall("SELECT ktMennyiseg, ktStatus FROM kosar_tetelek WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");

if ($termek = $termeklekeres->fetch_assoc()) {
    if ($termek['ktStatus'] == 0) {

        sqlsave("UPDATE kosar_tetelek SET ktMennyiseg = 0, ktStatus = 1 WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");
    }

    $ujMennyiseg = $termek['ktStatus'] == 0 ? 1 : $termek['ktMennyiseg'] + 1;
    sqlsave("UPDATE kosar_tetelek SET ktMennyiseg = $ujMennyiseg WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");
} else {
    sqlsave("INSERT INTO kosar_tetelek (ktkoID, ktTipus, ktBeazonosito, ktMennyiseg, ktStatus) VALUES ($koID, 'TERMEK', $teid, 1, 1)");
}

echo "<script>if(window.parent){window.parent.location.reload();}</script>";
?>
