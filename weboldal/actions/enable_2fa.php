<?php
session_start();
require("sqlcall.php");
require("mail.php");

$uid = $_SESSION["uid"] ?? $_SESSION["2fa_uid"];
if (!$uid) {
    die("Hiba: nincs bejelentkezett felhasználó.");
}
$code = rand(100000, 999999);
$expiry = date('Y-m-d H:i:s', time() + 300);

$sql = "UPDATE user SET u2FACode='$code', u2FAExpiry='$expiry' WHERE uID='$uid'";
sqlsave($sql);

$result = sqlcall("SELECT uemail FROM user WHERE uID='$uid'");
$user = $result->fetch_assoc();
$email = $user['uemail'];

sendMail($email, "2fa", $code);

echo "<script>window.parent.location.href = 'https://liftzone.hu/?o=2fa';</script>";
exit;
?>
