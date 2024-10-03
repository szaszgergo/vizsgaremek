<?php
require("sqlcall.php");
//form adatok lekérdezési a POST-ból
$username = $_POST["username"];
$email = $_POST["email"];
$date =  $_POST["date"];

//megnezzuk foglalt e már az email cim
$sqllekerdezes = "SELECT uID FROM user WHERE uemail = '$email'";
$tabla = sqlcall($sqllekerdezes);
$row = $tabla->fetch_row();
//ha van eredmeny lekerdezesbe == van mar ilyen email
if (isset($row)) {
    echo "foglalt email";
    //hibaüzenet küldése
    $_SESSION["hiba"] = "Ez az email cím már foglalt!";
    echo "<script>
        window.top.postMessage({loginError: '" . $_SESSION['hiba'] . "'}, '*');
    </script>";
    exit();
} else {
    echo "szabad emial";
    //jelszo hashelése BLOWFISH algoritmussal
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $curdate  = date('Y-m-d h:i:s', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    session_start();
    $sessionid = session_id();
    //sql insert statement osszerakása
    $sql = "INSERT INTO user (uID, uFelhasznalonev, uemail, uPassword, uSzuletesidatum, uRegisztracio, uIP, uSession, uStatus, uKomment)
    VALUES ('', '$username', '$email', '$password', '$date', '$curdate', '$ip', '$sessionid', 'a', '.')";
    //sql meghivása
    sqlsave($sql);
    echo "<script>window.top.postMessage({loginSuccess: true}, '*');</script>";
}





