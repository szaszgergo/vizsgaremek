<?php
require("sqlcall.php");
session_start();
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["date"])) {
    //form adatok lekérdezési a POST-ból
    $email = $_POST["email"];
    $date =  $_POST["date"];

    //sql insert statement osszerakása
    $sql = "UPDATE user SET uemail = '$email', uSzuletesidatum = '$date' WHERE uid = $_SESSION[uid]";
    //sql meghivása
    sqlsave($sql);
    }




