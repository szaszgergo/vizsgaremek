<?php
require("sqlcall.php");
require("mail.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM megbizhato WHERE megToken = '$token' AND megStatus = '0'";
    $result = sqlcall($sql);

    $row = $result->fetch_assoc();
    $email = $row['megEmail'];

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE megbizhato SET megStatus = '1' WHERE megToken = '$token'";
        sqlsave($sql_update);

        sendMail($email, "sikeresToken");
    } else {
        sendMail($email, "sikertelenToken");
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
