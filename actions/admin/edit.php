<?php
    require('../sqlcall.php');
    require("../formhandling.php");

    $uid = intval($_POST['uid']);
    $komment = $_POST['ukomment'];
    $email = $_POST['uemail'];
    $felhasznalonev = $_POST['ufelhasznalonev'];
    echo $_POST['uid'];
    sqlsave("UPDATE user SET uKomment = '$komment', uemail = '$email', uFelhasznalonev = '$felhasznalonev' WHERE uID = $uid");
    echo "<script>window.top.postMessage({editSuccess: true}, '*');</script>";
?>