<?php
session_start();
require("sqlcall.php");

$leiras = trim($_POST["edzo_leirasa"]);
$eid = $_POST['eid'];

$sql = "UPDATE szemelyi_edzok SET szeLeiras = ? WHERE szeID = ?";

sqlcall($sql, "si", [$leiras, $eid]);
?>