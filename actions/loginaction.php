<?php
//ezis megvan apiba majd torolni
require("sqlcall.php");
session_start();
//form adatok lekérdezési a POST-ból

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $name = $_POST["username"];
    $password = $_POST["password"];

    //megnezzuk helyes fiokba akar e belepni?
    $sqllekerdezes = "SELECT uID, uPassword FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    //ha helyes volt akkor az idjet es a hashelt jelszot megkapjuk
    $row = $tabla->fetch_row();
    $hashedpassword = $row[1];
    print_r($row);


    if(password_verify($password, $hashedpassword)){
        $uid = $row[0];
        //lementjuk a tovabbiakert
        $_SESSION["uid"] = $uid;
        //login tábla kitöltése
        $curdate  = date('Y-m-d h:i:s', time());
        $ip = $_SERVER['REMOTE_ADDR'];
        $sessionid = session_id();
        $url = $_SERVER['REQUEST_URI'];
        $sql = "INSERT INTO login (lID, lDatum, lIP, lSession, luID)
        VALUES ('', '$curdate', '$ip', '$sessionid', '$uid')";
        sqlsave($sql);
        //sessionbe mentjuk a sikeres bejelentkezest
        $_SESSION["loggedin"] = "true";
        unset($_SESSION['hiba']);
        echo "<script>window.top.postMessage({loginSuccess: true}, '*');</script>";

    } else{
        $_SESSION["hiba"] = "Helytelen belépési adatok!!";
        echo "<script>
            window.top.postMessage({loginError: '" . $_SESSION['hiba'] . "'}, '*');
        </script>";
        exit();
    }
}


