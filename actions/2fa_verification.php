<?php
session_start();
require("sqlcall.php");
require("mail.php");

// if(isset($_SESSION["uid"])) {
//     $_SESSION["2fa_uid"] = $_SESSION["uid"];
//     $uid = $_SESSION["2fa_uid"];
// }

// if (!isset($_SESSION["2fa_uid"])) {
//     die("Nincs folyamatban lévő 2FA hitelesítés.");
// }

if (!isset($_SESSION["uid"]) && isset($_SESSION["2fa_uid"])) {
    $_SESSION["uid"] = $_SESSION["2fa_uid"];
}
$uid = $_SESSION["uid"] ?? null;

if (!$uid) {
    die("Nincs folyamatban lévő 2FA hitelesítés.");
}

$code = $_POST["code"];

$sql = "SELECT u2FACode, u2FAExpiry FROM user WHERE uID='$uid'";
$result = sqlcall($sql);
$row = $result->fetch_assoc();

if ($row['u2FACode'] == $code && strtotime($row['u2FAExpiry']) > time()) {
    $_SESSION["uid"] = $uid;

    sqlsave("UPDATE user SET u2FACode=NULL, u2FAExpiry=NULL, u2FAStatus=1 WHERE uID='$uid'");

    echo "<script>window.location.href = 'https://liftzone.hu/?o=fiok';</script>";
} else {
    echo "Hibás vagy lejárt kód!";
}
?>