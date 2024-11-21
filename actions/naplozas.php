<?php
function naplo(){require("sqlcall.php");
$curdate  = date('Y-m-d h:i:s', time());
$ip = $_SERVER['REMOTE_ADDR'];
$sessionid = session_id();
$url = $_SERVER['REQUEST_URI'];
if(isset($_SESSION["uid"])){
    $uid = $_SESSION["uid"];
} else{
    $uid = '';
}
$sql = "INSERT INTO naplo (nID, nDatum, nIP, nSession, nuID, nURL)
VALUES ('', '$curdate', '$ip', '$sessionid', '$uid', '$url')";
sqlsave($sql);
}