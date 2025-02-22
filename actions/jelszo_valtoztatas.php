<?php
session_start();
require("sqlcall.php");
require("getuserinfo.php");
require("formhandling.php");
require("mail.php");

$adatok = getUserInfo();

//regi jelszo helyes e
if (!password_verify($_POST['oldpw'], $adatok['uPassword'])) {
   hibaUzenet("Nem helyes a régi jelszó!");
}
//uj jelszo helyes formatum e
checkPassword($_POST["newpw"]);

//uj jelszo hash és lementés
$newpw=password_hash($_POST['newpw'],PASSWORD_BCRYPT);
$sql = "UPDATE user SET uPassword = '$newpw' WHERE uid = $_SESSION[uid] ";
sqlcall($sql);

sendMail($adatok['uemail'], "jelszoValtoztatas");
//sikeres lefutás
formSuccess();
?>
