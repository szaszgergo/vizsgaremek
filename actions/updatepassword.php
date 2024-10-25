<?php
session_start();
require("sqlcall.php");
require("getuserinfo.php");

$adatok = getUserInfo();
if (!password_verify($_POST['oldpw'],$adatok[4])) {
   print"<script> alert('Nem helyes a két jelszó!')</script>"; 
   exit();
}


$newpw=password_hash($_POST['newpw'],PASSWORD_BCRYPT);
$sql = "UPDATE user SET uPassword = '$newpw' WHERE uid = $_SESSION[uid] ";
sqlcall($sql);

