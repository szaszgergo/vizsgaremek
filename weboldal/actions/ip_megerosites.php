<?php
require("sqlcall.php");
require("formhandling.php");
require("mail.php");

if (isset($_GET['ip']) && isset($_GET['uid'])) {
    $ip = $_GET['ip'];
    $uid = $_GET['uid'];

    $sql = "SELECT * FROM megbizhato WHERE megIP = '$ip' AND megUID = '$uid'";
    $result = sqlcall($sql);
    $row = $result->fetch_assoc();
    $email = $row['megEmail'];

    $sql2 = "UPDATE megbizhato SET megBan = 1 WHERE megIP = '$ip' AND megUID = '$uid'";
    sqlsave($sql2);
    sendMail($email, "ban");
    echo "<script>window.location.href = 'https://liftzone.hu/actions/kijelentkezes.php';</script>";
}

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
        echo "<script>window.location.href = 'https://liftzone.hu/?o=fiok';</script>";
    } else {
        sendMail($email, "sikertelenToken");
        header("Location: /");
    }
}
