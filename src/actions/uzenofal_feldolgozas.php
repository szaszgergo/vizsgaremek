<?php
session_start();
require("sqlcall.php");
print_r($_FILES['kep']);
$kepnev = $_SESSION['uid']."_".date("ymdHis")."_".uniqid('', true); 
$kepadat = $_FILES['kep'];
$vankep = $_FILES['kep']['size'] > 0;
if ($vankep) {
    if($kepadat['type']=='image/jpeg') $kiterj=".jpg";else
    if($kepadat['type']=='image/png') $kiterj=".png";else
    if($kepadat['type']=='image/gif') $kiterj=".gif";else{
    echo "<script>window.top.postMessage({loginError: 'A kép csak .JPG, vagy .PNG, vagy .GIF formátumú lehet!'}, '*');</script>";
    die();}
    $kepnev.= $kiterj;
    move_uploaded_file($kepadat['tmp_name'],"../images/uzenofal/".$kepnev);
}


if (isset($_POST["cim"]) && isset($_POST["szoveg"])) {
    $cim = $_POST["cim"];
    $szoveg = $_POST["szoveg"];
    $curdate = date('Y-m-d H:i:s');

    if ($vankep) {
        $sql = "INSERT INTO uzenofal (uzenoCim, uzenoSzoveg, uzenoDatum, uzenoKep) VALUES (?, ?, ?, ?)";
        $params = [$cim, $szoveg, $curdate, $kepnev];
        $types = "ssss";
      
        $result = sqlsave($sql, $types, $params);
    }
    else {
        $sql = "INSERT INTO uzenofal (uzenoCim, uzenoSzoveg, uzenoDatum) VALUES (?, ?, ?)";
        $params = [$cim, $szoveg, $curdate];
        $types = "sss";
  
        $result = sqlsave($sql, $types, $params);
    }
    if ($result) {
        echo "<script>window.top.postMessage({success: 'A közzététel sikeres volt!'}, '*');</script>";

    } else {
        echo "<script>window.top.postMessage({loginError: 'A közzététel sikertelen volt!'}, '*');</script>";

    }
}