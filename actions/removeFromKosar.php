<?php
session_start();
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
    $currentMennyiseg = $termek['ktMennyiseg'];
    $newMennyiseg = $currentMennyiseg - 1;

    if ($newMennyiseg > 0) {
        sqlsave("UPDATE kosar_Tetelek SET ktMennyiseg = $newMennyiseg WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");
    } else {
        sqlsave("UPDATE kosar_Tetelek SET ktMennyiseg = 0, ktStatus = 0 WHERE ktkoID = $koID AND ktBeazonosito = $teid AND ktTipus = 'TERMEK'");
    }
} else {
    echo "<alert>Termék nem található a kosárban!</alert>";
}

?>
