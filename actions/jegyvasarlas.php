<?php
require("sqlcall.php");
session_start();
$uid = $_SESSION["uid"];
// $jtid = $_POST["jtid"]; majd a formbol
$jtid = "5";
//a tipus alapjan lekerjuk milyen hosszu
$sqljegy = "SELECT * FROM `tipusok` WHERE tpID = $jtid";
$adatok = sqlcall($sqljegy);
$jegy = $adatok->fetch_row();

if ($jegy[3] == NULL) {
    $hossz = 60;
} else{
    $hossz = $jegy[3];
}


$sql = "INSERT INTO `jegyek`(`jID`, `juID`, `jtID`, `jStatus`, `jLejarat`) 
VALUES ('', '$uid', '$jtid', 1, CURRENT_TIMESTAMP + INTERVAL $hossz DAY);";
sqlsave($sql);