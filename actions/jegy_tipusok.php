<?php
//api-ba mar megvan majd törölni kell
function getJegyTipusAdatok($tipus){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM tipusok WHERE tpID = $tipus";
    $sor = sqlcall($sql)->fetch_row();
    return $sor;
}

?>