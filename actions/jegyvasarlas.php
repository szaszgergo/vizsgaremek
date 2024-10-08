<?php
require("sqlcall.php");
session_start();
$uid = $_SESSION["uid"];
$jtid = $_POST["jtid"];
//a tipus alapjan lekerjuk milyen hosszu
$sqljegy = "SELECT * FROM `tipusok` WHERE tpID = $jtid";
$adatok = sqlcall($sqljegy);
$jegy = $adatok->fetch_row();

$hossz = $jegy[3];
$alkalmak = $jegy[4];



$sql = "INSERT INTO `jegyek`(`jID`, `juID`, `jtID`, `jStatus`, `jLejarat`, `jAlkalmak`) 
VALUES ('', '$uid', '$jtid', 1, CURRENT_TIMESTAMP + INTERVAL $hossz DAY, $alkalmak);";
sqlsave($sql);