<?php
session_start();
require("sqlcall.php");
require("mail.php");

if (!isset($_SESSION["uid"])) {
    die("Nincs bejelentkezve!");
}

$uid = $_SESSION["uid"];
$code = rand(100000, 999999);
$expiry = date('Y-m-d H:i:s', time() + 300); // 5 percig érvényes

$sql = "UPDATE user SET u2FACode='$code', u2FAExpiry='$expiry' WHERE uID='$uid'";
sqlsave($sql);

$result = sqlcall("SELECT uemail FROM user WHERE uID='$uid'");
$user = $result->fetch_assoc();
$email = $user['uemail'];

sendMail($email, "2FA", "Az Ön 2FA kódja: $code");

header("Location: https://liftzone.hu/?o=2fa");
exit();
?>  
