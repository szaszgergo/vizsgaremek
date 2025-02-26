<?php
require("mail.php");
require("sqlcall.php");

$select_uid = sqlcall("SELECT * FROM `ertesites` WHERE ertDatum REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$'");
$uid = $select_uid->fetch_assoc()["ertuID"];

$select_email = sqlcall("SELECT * FROM user WHERE uID = '$uid'");
$email = $select_email->fetch_assoc()["uemail"];

sendMail($email, "ertesites");

?>