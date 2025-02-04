<?php
require("../sqlcall.php");
$uid = $_POST['id'];

$sql = "UPDATE `user` SET uSzerep = 1 WHERE uID = $uid";
sqlcall($sql);  
$sql = "UPDATE `szemelyi_edzok` SET szeStatus = 'd' WHERE szeuID = $uid";
sqlcall($sql);  

echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>