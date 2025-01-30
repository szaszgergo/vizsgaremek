<?php
require("../sqlcall.php");
$uid = $_POST['uID'];

$sql = "UPDATE `user` SET uSzerep = 3 WHERE uID = $uid";
sqlcall($sql);  

echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>