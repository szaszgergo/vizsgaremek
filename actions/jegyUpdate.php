<?php
require("sqlcall.php");
$sql = "UPDATE jegyek SET jStatus = 0 WHERE jLejarat <= NOW() AND jStatus != 0";
sqlcall($sql);
?>
