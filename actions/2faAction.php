<?php
session_start();
require("sqlcall.php");
require("formhandling.php");
var_dump($_POST);

if (isset($_POST["felhasznalonev"]) && isset($_POST["jelszo"])) {
    $name = $_POST["felhasznalonev"];
    $password = $_POST["jelszo"];

    var_dump($uid);

    $sqllekerdezes = "SELECT * FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    $row = $tabla->fetch_assoc();
    $uid = $row['uID'];
    $hashedpassword = $row['uPassword'];

    if($uid !== $_SESSION["uid"]) {
        hibaUzenet("Rossz felhasználó!");
        exit();
    } else {
        if (password_verify($password, $hashedpassword)) {
            echo "<script>window.parent.location.href = '/actions/disable_2fa.php';</script>";
            exit();
        } else {
            hibaUzenet("Helytelen belépési adatok!!");
            exit();
        }
    }
}

?>