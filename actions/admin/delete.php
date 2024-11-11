<?php
    require('../sqlcall.php');
    require("../formhandling.php");

    $uid = intval($_POST['uid']);
    echo $_POST['uid'];
    sqlsave("UPDATE user SET uStatus = 'Deleted' WHERE uID = $uid");
    echo "<script>window.top.postMessage({editSuccess: true}, '*');</script>";
?>