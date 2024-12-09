<?php
require("sqlcall.php");

if(isset($_POST["cim"]) && isset($_POST["szoveg"])) {
    $cim = $_POST["cim"];
    $szoveg = $_POST["szoveg"];
    $curdate = date('Y-m-d H:i:s');
    
    $kep = null;
    if(isset($_FILES["kep"]) && $_FILES["kep"]["error"] == 0) {
        $target_dir = "C:/xampp/htdocs/vizsgaremek/images/uzenofal/";
        $target_file = $target_dir . basename($_FILES["kep"]["name"]);
        if(move_uploaded_file($_FILES["kep"]["tmp_name"], $target_file)) {
            $kep = $target_file;
        }
    }

    $sql = "INSERT INTO uzenofal (uzenoCim, uzenoSzoveg, uzenoDatum, uzenoKep) VALUES (?, ?, ?, ?)";
    $params = [$cim, $szoveg, $curdate, $kep];
    $types = "ssss";
    sqlsave($sql, $types, $params);
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    exit();
}