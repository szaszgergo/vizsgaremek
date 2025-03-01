<?php
require("../sqlcall.php");
require("../mail.php");
require("../getuserinfo.php");

$adatok = getUserInfo();

$uid = $_POST['uID'];

$sql = "UPDATE `user` SET uSzerep = 3 WHERE uID = $uid";
sqlcall($sql);  


$edzotablasql = "INSERT INTO szemelyi_edzok
( szeUID, szeVegzetseg, szeLeiras, szeElerhetoseg, szeKepek,  szeStatus) VALUES
($uid, '', '', '', '', 'a');";
sqlsave($edzotablasql);

sendMail($adatok['uemail'], "edzoPromotalas");
echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>