<?php
session_start();
require("sqlcall.php");
require("mail.php");

$uid = $_SESSION["uid"] ?? $_SESSION["2fa_uid"];
if (!$uid) {
    die("Hiba: nincs bejelentkezett felhasználó.");
}

$sql = "UPDATE user SET u2FAStatus=0 WHERE uID='$uid'";
sqlsave($sql);

$result = sqlcall("SELECT uemail FROM user WHERE uID='$uid'");
$user = $result->fetch_assoc();
$email = $user['uemail'];

sendMail($email, "2fa_disable");

echo "<script>window.parent.location.href = 'https://liftzone.hu/actions/kijelentkezes.php';</script>";
exit;
?>