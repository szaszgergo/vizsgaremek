<?php
session_start(); 
require("sqlcall.php");

$edzetevele = 1; //ha meglesz írva a jelentkezés akkor sqlbol kell meg

if (isset($_SESSION["uid"]) && isset($_POST['eid']) && !empty($_POST['textarea_komment']) && $edzetevele == 1) {
    $uid = $_SESSION["uid"];
    $eid = $_POST['eid'];
    $ekKomment = trim($_POST['textarea_komment']); 
    $sql = "UPDATE edzok_kommentek SET ekKomment = ?, ekDatum = NOW() WHERE ekUserID = ? AND ekSzeID = ?";
    $affected_rows = sqlcall($sql, 'sii', [$ekKomment, $uid, $eid]);
    echo "<script>window.top.postMessage({success: 'Sikeresen szerkesztetted a véleményedet!'}, '*');</script>";
  
} else {
    echo "<script>window.top.postMessage({loginError: 'Nem vagy bejelentkezve vagy nem írtál véleményt!'}, '*');</script>";
}
?>

