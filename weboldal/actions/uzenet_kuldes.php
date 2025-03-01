<?php
session_start();
require("sqlcall.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Nem megfelelő email cím!'); window.location.href='oldalak/main.php';</script>";
        exit();
    }
    if (empty($_POST["message"])) {
        echo "<script>alert('Hiányzik az üzenet!'); window.location.href='oldalak/main.php';</script>";
        exit();
    }
    else{
        echo "<script>alert('Sikeres üzenetküldés!');</script>";

        $ip = $_SERVER['REMOTE_ADDR'];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $curdate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO messages (mEmail, mUzenet, mDate, mIP)
                VALUES (?, ?, ?, ?)";
        sqlsave($sql, 'ssss', [$email, $message, $curdate, $ip]);
    
        echo "<script>window.top.postMessage({Success: true}, '*');</script>";
    
        exit();
    }
}
?>