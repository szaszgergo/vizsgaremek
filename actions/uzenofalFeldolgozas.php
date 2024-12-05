<?php
require("sqlcall.php");
if(isset($_POST["cim"]) && isset($_POST["szoveg"])) {
    $cim = $_POST["cim"];
    $szoveg = $_POST["szoveg"];
    $curdate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO uzenofal (uzenoCim, uzenoSzoveg, uzenoDatum) VALUES (?, ?, ?)";
    $params = [$cim, $szoveg, $curdate];
    $types = "sss";
    sqlsave($sql, $types, $params);
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    exit();
}