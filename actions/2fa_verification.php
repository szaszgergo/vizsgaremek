<?php
session_start();
require("../sqlcall.php");
require("../mail.php");

if (!isset($_SESSION["2fa_uid"])) {
    die("Nincs folyamatban lévő 2FA hitelesítés.");
}

$uid = $_SESSION["2fa_uid"];
$code = $_POST["code"];

$sql = "SELECT u2FACode, u2FAExpiry FROM user WHERE uID='$uid'";
$result = sqlcall($sql);
$row = $result->fetch_assoc();

if ($row['u2FACode'] == $code && strtotime($row['u2FAExpiry']) > time()) {
    $_SESSION["uid"] = $uid;
    unset($_SESSION["2fa_uid"]);

    sqlsave("UPDATE user SET u2FACode=NULL, u2FAExpiry=NULL WHERE uID='$uid'");

    echo "Sikeres bejelentkezés!";
} else {
    echo "Hibás vagy lejárt kód!";
}
?>