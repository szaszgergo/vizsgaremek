<?php
require("sqlcall.php");
require("getuserinfo.php");
session_start();

$jID = $_POST["jID"];

$datum = date("Y-m-d H:i:s");

$sql = "UPDATE jegyek SET jStatus = 0, jLejarat = '$datum' WHERE jID = $jID";
sqlcall($sql);
echo "<script>if(window.parent){window.parent.location.reload();}</script>";

?>