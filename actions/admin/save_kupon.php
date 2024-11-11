<?php
require("../sqlcall.php");
require("../formhandling.php");
$kKod = $_POST['kKod'];

$kSzazalek = isset($_POST['kSzazalek']) && $_POST['kSzazalek'] !== '' ? $_POST['kSzazalek'] : 0;
$kOsszeg = isset($_POST['kOsszeg']) && $_POST['kOsszeg'] !== '' ? $_POST['kOsszeg'] : 0;
$kAlkalmak = isset($_POST['kAlkalmak']) && $_POST['kAlkalmak'] !== '' ? $_POST['kAlkalmak'] : 'NULL';

if ($kSzazalek == 0 && $kOsszeg == 0) {
    hibaUzenet("Vagy az összeget vagy a százalékot add meg");
}


$kErvenyes_tol = $_POST['kErvenyes_tol'];
$kErvenyes_ig = $_POST['kErvenyes_ig'];
$sql = "INSERT INTO `kuponok`(`kKod`, `kSzazalek`, `kOsszeg`, `kAlkalmak`, `kErvenyes_tol`, `kErvenyes_ig`)
VALUES
('$kKod', $kSzazalek, $kOsszeg, $kAlkalmak, $kErvenyes_tol, $kErvenyes_ig)";


sqlsave($sql);
echo "<script>window.top.postMessage({editSuccess: true}, '*');</script>";

?>