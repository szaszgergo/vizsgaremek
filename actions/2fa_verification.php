<?php
session_start();
require("sqlcall.php");
require("mail.php");
require("formhandling.php");

if (!isset($_SESSION["uid"]) && isset($_SESSION["2fa_uid"])) {
    $_SESSION["uid"] = $_SESSION["2fa_uid"];
}
$uid = $_SESSION["uid"] ?? null;

if (!$uid) {
    die("Nincs folyamatban lévő 2FA hitelesítés.");
}

$code = $_POST["code"];

$sql = "SELECT * FROM user WHERE uID='$uid'";
$result = sqlcall($sql);
$row = $result->fetch_assoc();
$email = $row['uemail'];

$ifAlreadyEnabled = $row['u2FAStatus'] == 1;

if ($row['u2FACode'] == $code && strtotime($row['u2FAExpiry']) > time()) {
    $_SESSION["uid"] = $uid;
    sqlsave("UPDATE user SET u2FACode=NULL, u2FAExpiry=NULL, u2FAStatus=1 WHERE uID='$uid'");
    if(!$ifAlreadyEnabled) {
        sendMail($email, "2fa_enable");
    }
    echo "<script>window.parent.location.href = 'https://liftzone.hu/?o=fiok';</script>";
    exit();
} else {
    hibaUzenet("Helytelen kód!");
    exit();
}
?>