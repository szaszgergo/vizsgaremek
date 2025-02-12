<?php
session_start();
require("sqlcall.php");

$leiras = trim($_POST["edzo_leirasa"]);
$email = $_POST["mentes_email"];
$telefon = $_POST["mentes_telefon"];
$vegzettsegek = $_POST["mentes_vegzettseg"];
$nev = $_POST["mentes_nev"];
$eid = $_POST['eid'];

$kepnev = $_SESSION['uid'] . "_" . date("ymdHis") . "_" . uniqid('', true);
$kepadat = $_FILES['mentes_kep'];
$vankep = $_FILES['mentes_kep']['size'] > 0;

if ($vankep) {
    if ($kepadat['type'] == 'image/jpeg') $kiterj = ".jpg";
    else if ($kepadat['type'] == 'image/png') $kiterj = ".png";
    else if ($kepadat['type'] == 'image/gif') $kiterj = ".gif";
    else {
        echo "A kép csak .JPG, vagy .PNG, vagy .GIF formátumú lehet!";
        die();
    }
    $kepnev .= $kiterj;
    $upload_path = "../images/" . $kepnev;
    if (move_uploaded_file($kepadat['tmp_name'], $upload_path)) {
        $og_pic = $kepadat['name'];
    } else {
        echo "Hiba történt a fájl feltöltésekor.";
        die();
    }
} else {
    $kepnev = "";
}

if($vankep) {
    $sql = "UPDATE szemelyi_edzok SET szeLeiras = ?, szeEmail = ?, szeTelefon = ?, szeVegzetseg = ?, szeuFelhasznalonev = ?, szeKepek = ? WHERE szeID = ?";

    sqlcall($sql, "ssssssi", [$leiras, $email, $telefon, $vegzettsegek, $nev, "images/" . $kepnev, $eid]);
} else {
    $sql = "UPDATE szemelyi_edzok SET szeLeiras = ?, szeEmail = ?, szeTelefon = ?, szeVegzetseg = ?, szeuFelhasznalonev = ? WHERE szeID = ?";

    sqlcall($sql, "sssssi", [$leiras, $email, $telefon, $vegzettsegek, $nev, $eid]);
}

echo "<script>if(window.parent){window.parent.location.reload();}</script>";
?>