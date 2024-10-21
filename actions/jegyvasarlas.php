<?php
require("sqlcall.php");
session_start();
$uid = $_SESSION["uid"];
$tpID = $_POST["tpID"];
//a tipus alapjan lekerjuk milyen hosszu
$sqljegy = "SELECT * FROM `tipusok` WHERE tpID = $tpID";
$adatok = sqlcall($sqljegy);
$jegy = $adatok->fetch_row();

$hossz = $jegy[3];
$alkalmak = $jegy[4];
$alkalmak_ertek = is_null($alkalmak) ? 'NULL' : $alkalmak;


$jegyeksql = "INSERT INTO `jegyek`(`juID`, `jtID`, `jStatus`, `jLejarat`, `jAlkalmak`) 
VALUES ('$uid', '$tpID', 1, CURRENT_TIMESTAMP + INTERVAL $hossz DAY, $alkalmak_ertek);";

$tranzakciosql = "INSERT INTO `tranzakciok`(`tuID`, `tMod`, `tOsszeg`, `tStatus`, `tkID`)
VALUES ('$uid','Kártya','$jegy[2]','1','0');";

sqlsave($tranzakciosql);
sqlsave($jegyeksql);
echo "<script>window.top.postMessage({purchaseSuccess: true}, '*');</script>";
