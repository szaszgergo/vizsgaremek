<?php
function getUserInfo(){
    include_once("sqlcall.php");
    $sql = "SELECT * FROM user WHERE uID = '$_SESSION[uid]'";
    $tabla = sqlcall($sql);
    $row = $tabla->fetch_row();
    return $row;
}
?>