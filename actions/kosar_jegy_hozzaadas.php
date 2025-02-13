<?php
session_start();
require("sqlcall.php");

$tpID = $_POST["tpID"]; 
$uid = $_SESSION["uid"]; 
$kosarlekeres = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL");
$kosar = $kosarlekeres->fetch_assoc();

if (!$kosar) {
    sqlsave("INSERT INTO kosar (koUID, koTranzakcioID) VALUES ($uid, NULL)");

    $kosarlekeres = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL");
    $kosar = $kosarlekeres->fetch_assoc();
}

$koID = $kosar["koID"];
$JEGYlekeres = sqlcall("SELECT ktMennyiseg, ktStatus FROM kosar_tetelek WHERE ktkoID = $koID AND ktBeazonosito = $tpID AND ktTipus = 'JEGY'");

if ($JEGY = $JEGYlekeres->fetch_assoc()) {
    if ($JEGY['ktStatus'] == 0) {

        sqlsave("UPDATE kosar_tetelek SET ktMennyiseg = 0, ktStatus = 1 WHERE ktkoID = $koID AND ktBeazonosito = $tpID AND ktTipus = 'JEGY'");
    }

    $ujMennyiseg = $JEGY['ktStatus'] == 0 ? 1 : $JEGY['ktMennyiseg'] + 1;
    sqlsave("UPDATE kosar_tetelek SET ktMennyiseg = $ujMennyiseg WHERE ktkoID = $koID AND ktBeazonosito = $tpID AND ktTipus = 'JEGY'");
} else {
    sqlsave("INSERT INTO kosar_tetelek (ktkoID, ktTipus, ktBeazonosito, ktMennyiseg, ktStatus) VALUES ($koID, 'JEGY', $tpID, 1, 1)");
}

echo "<script>if(window.parent){window.parent.location.reload();}</script>";
?>
