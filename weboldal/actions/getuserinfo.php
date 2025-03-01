<?php
//api-vá alakitva pipa majd torolni
function getUserInfo(){
    include_once("sqlcall.php");
    if (isset($_SESSION['uid'])) {
        $sql = "SELECT * FROM user WHERE uID = '$_SESSION[uid]'";
        $tabla = sqlcall($sql);
        $row = $tabla->fetch_assoc();
        return $row;
    }
    return [];
}
function getUserJegyek(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM jegyek WHERE juID = '$_SESSION[uid]' AND jStatus != 1 ORDER BY jStatus DESC";
    $tabla = sqlcall($sql);
    return $tabla;
}
function getUserJegy(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM jegyek WHERE juID = '$_SESSION[uid]' AND jStatus = 1";
    $tabla = sqlcall($sql);
    return $tabla->fetch_assoc();
}


function getUserKosarak(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM kosar WHERE koUID = '$_SESSION[uid]' AND koTranzakcioID IS NOT NULL ORDER BY koID DESC";
    $tabla = sqlcall($sql);
    return $tabla;
}




function getUserEdzok(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM szemelyi_edzok";
    $tabla = sqlcall($sql);
    return $tabla;
}
?>