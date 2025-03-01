<?php
require("sqlcall.php");
require("getuserinfo.php");
session_start();

$jID = $_POST["jID"];

$jegy = getUserJegy();

if (isset($jegy)){
    echo "<script>if(window.parent){alert('Már van aktív jegyed!');}</script>";
    exit();
}


$datum = date("Y-m-d H:i:s");

$jtid = sqlcall("SELECT jtID FROM jegyek WHERE jID = $jID")->fetch_row()[0];
$hossz = sqlcall("SELECT tpHossz FROM tipusok WHERE tpID = $jtid")->fetch_row()[0];

$lejarat = date("Y-m-d H:i:s", strtotime($datum . " + $hossz days"));


$sql = "UPDATE jegyek SET jStatus = 1, jKezdes = '$datum', jLejarat = '$lejarat' WHERE jID = $jID";
sqlcall($sql);
echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>