<?php
require("mail.php");
require("sqlcall.php");

$select_uid = sqlcall("SELECT * FROM `ertesites` WHERE ertDatum REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$'");
$uid = $select_uid->fetch_assoc()["ertuID"];

$select_email = sqlcall("SELECT * FROM user WHERE uID = '$uid'");
$email = $select_email->fetch_assoc()["uemail"];

$jegy = sqlcall("SELECT * FROM `ertesites` WHERE ertDatum REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$'");
$jegy = $jegy->fetch_assoc()["ertjID"];

$lejarat = sqlcall("SELECT * FROM jegy WHERE jID = '$jegy' AND jStatus = 1");
$lejarat = $lejarat->fetch_assoc()["jLejarat"];

$daysTillExpire = strtotime($lejarat) - strtotime(date("Y-m-d H:i:s"));
$daysTillExpire = floor($daysTillExpire / (60 * 60 * 24));

if ($daysTillExpire < 0) {
    $daysTillExpire = 0;
}


switch ($daysTillExpire) {
    case 0:
        sendMail($email, "ertesitesma");
        break;
    case 1:
        sendMail($email, "ertesitesholnap");
        break;
    default:
        sendMail($email, "ertesitesxnap", $daysTillExpire);
        break;
}



?>