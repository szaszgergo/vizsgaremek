<?php
//api-vá alakitva pipa majd torolni
function getUserInfo(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM user WHERE uID = '$_SESSION[uid]'";
    $tabla = sqlcall($sql);
    $row = $tabla->fetch_row();
    return $row;
}
function getUserJegyek(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM jegyek WHERE juID = '$_SESSION[uid]' AND jStatus = 1";
    $tabla = sqlcall($sql);
    //csak 1 sornak kéne lennie ahhol a status 1 ha tobb van valamit elbasztunk szoval itt eleg a sort visszaküldeni
    return $tabla->fetch_row();
}
function getUserEdzok(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM szemelyi_edzok";
    $tabla = sqlcall($sql);
    return $tabla;
}
?>