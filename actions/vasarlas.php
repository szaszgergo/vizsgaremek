<?php
require("sqlcall.php");
require("kosar_tartalom.php");
require("mail.php");
require("getuserinfo.php");
session_start();
$adatok = getUserInfo();
$kosar = getKosarContent();


$uid = $_SESSION["uid"];


//check of cart is empty
if (empty($kosar)) {
    echo "<script>alert('A kosár üres!');</script>";
    echo "<script>if(window.parent){window.parent.location.reload();}</script>";
    exit();
}




//put purchesed passes into jegyek table
foreach ($kosar as $item) {
    if ($item['type'] === 'JEGY') {
        $tpID = $item['details']['tpID'];
        $tpAlkalmak = $item['details']['tpAlkalmak'];
        $alkalmak_ertek = is_null($tpAlkalmak) ? 'NULL' : $tpAlkalmak;
        $sql = "INSERT INTO jegyek (jUID, jtID, jKezdes, jLejarat, jStatus, jAlkalmak) VALUES ($uid, $tpID, NULL, NULL, 2, $alkalmak_ertek)";
        sqlcall($sql);
        echo $sql;
    }
}

//remove kosar content  by setting ktStatus to 0 and ktMennyiseg to 0 on all kosar_tetelek where ktkoID is kosarid
$kosarid = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL")->fetch_assoc()["koID"];
$sqltermekek = "UPDATE kosar_tetelek SET ktStatus = 0 WHERE ktkoID = $kosarid";
sqlcall($sqltermekek);


//set tranzkaciID in kosar to 1
$sql = "UPDATE kosar SET koTranzakcioID = 1 WHERE koUID = $uid AND koTranzakcioID IS NULL";
sqlcall($sql);


sqlsave("INSERT INTO kosar (koUID, koTranzakcioID) VALUES ($uid, NULL)");


sendMail($adatok['uemail'], "vasarlas");
echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>
