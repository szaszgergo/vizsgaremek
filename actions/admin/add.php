<?php
require("../sqlcall.php");
$uid = $_POST['uID'];

$sql = "UPDATE `user` SET uSzerep = 3 WHERE uID = $uid";
sqlcall($sql);  


$edzotablasql = "INSERT INTO szemelyi_edzok
( szeUID, szeVegzetseg, szeLeiras, szeElerhetoseg, szeKepek,  szeStatus) VALUES
($uid, '', '', '', '', 'a');";
sqlsave($edzotablasql);



echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>