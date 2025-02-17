<?php
require("sqlcall.php");
require("kosar_tartalom.php");
session_start();
$kosar = getKosarContent();

// kosar = Array ( [0] => Array ( [type] => JEGY [details] =>
// Array ( [tpID] => 2 [tpNev] => Napijegy [tpAr] => 3990 [tpHossz] => 1 [tpAlkalmak] => 1 ) [count] => 1 )
// [1] => Array ( [type] => JEGY [details] => Array ( [tpID] => 3 [tpNev] => Három hónapos bérlet [tpAr] => 49900 [tpHossz] => 90 [tpAlkalmak] => ) [count] => 1 ) )
$uid = $_SESSION["uid"];

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
$sql = "UPDATE kosar_tetelek SET ktStatus = 0, ktMennyiseg = 0 WHERE ktkoID = $kosarid";
sqlcall($sql);





echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>