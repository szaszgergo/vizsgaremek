<?php
require("../sqlcall.php");
$uid = $_POST['id'];

$sql = "UPDATE `user` SET uSzerep = 1 WHERE uID = $uid";
sqlcall($sql);  

echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>