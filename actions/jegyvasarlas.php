<?php
require("sqlcall.php");
session_start();
$uid = $_SESSION["uid"];
// $jtid = $_POST["jtid"]; majd a formbol
$jtid = "5";
$hossz = 5;
$sql = "INSERT INTO `jegyek`(`jID`, `juID`, `jtID`, `jStatus`, `jLejarat`) 
VALUES ('', '4', '$jtid', 1, CURRENT_TIMESTAMP + INTERVAL $hossz YEAR);";
sqlsave($sql);