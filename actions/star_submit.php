<?php 
session_start();
require("sqlcall.php"); 
print_r($_POST);
$star_value = $_POST['star_value'];
$eid = $_POST['eid']; 
$csUID = $_SESSION['uid'];


// Check if the user is logged in
if (!isset($csUID)) {
    echo "<script>alert('Nem vagy bejelentkezve!');</script>";
    exit;
}
//
//user 1nel tobbszor off


// Check if a star was selected
if ($star_value == "0") {
    echo "<script>alert('Kérlek válassz egy csillagot!');</script>";
    exit;
}

// Insert into the database
$sql = "INSERT INTO csillag (CsUID,CsSzeID, Csillag_value) VALUES (?,?,?)";
sqlcall($sql,'iii',[$csUID,$eid,$star_value]);
echo "<script>alert('Sikeres értékelés!');</script>";

?>
