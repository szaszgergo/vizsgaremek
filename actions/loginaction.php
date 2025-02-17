<?php
//ezis megvan apiba majd torolni
session_start();
require("sqlcall.php");
require("formhandling.php");


if (isset($_POST["username"]) && isset($_POST["password"])) {
    $name = $_POST["username"];
    $password = $_POST["password"];

    //megnezzuk helyes fiokba akar e belepni?
    $sqllekerdezes = "SELECT uID, uPassword, uSzerep FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    //ha helyes volt akkor az idjet es a hashelt jelszot megkapjuk
    $row = $tabla->fetch_assoc();
    $hashedpassword = $row['uPassword'];
    print_r($row);


    if(password_verify($password, $hashedpassword)){
        $uid = $row['uID'];
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
        if ($row['uSzerep'] == "1") {
            $_SESSION['szerep'] = "user";
        }
        else if ($row['uSzerep'] == "2") {
            $_SESSION['szerep'] = "admin";
        }
        else if($row['uSzerep'] == "3"){
            $_SESSION['szerep'] = "edzo";
        }
        formSuccess();
        $sql_check_ip = "SELECT * FROM megbizhato WHERE megUID = '$uid' AND megStatus = '1'";
        if($sql_check_ip->num_rows == 0) {
            sendMail($email, "bejelentkezes");
        }
    } else{
        hibaUzenet("Helytelen belépési adatok!!");
        exit();
    }
}


