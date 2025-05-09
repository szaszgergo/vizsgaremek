<?php
session_start();
require("sqlcall.php");
require("formhandling.php");
require("mail.php");


if (isset($_POST["username"]) && isset($_POST["password"])) {
    $name = $_POST["username"];
    $password = $_POST["password"];

    //megnezzuk helyes fiokba akar e belepni?
    $sqllekerdezes = "SELECT * FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    //ha helyes volt akkor az idjet es a hashelt jelszot megkapjuk
    $row = $tabla->fetch_assoc();
    $hashedpassword = $row['uPassword'];
    

    if (password_verify($password, $hashedpassword)) {
        $uid = $row['uID'];
        if ($row['u2FAStatus'] === 1) {
            $_SESSION['2fa_uid'] = $uid;
            echo "<script>window.parent.location.href = 'https://liftzone.hu/actions/enable_2fa.php';</script>";
            exit();
        }        

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
        } else if ($row['uSzerep'] == "2") {
            $_SESSION['szerep'] = "admin";
        } else if ($row['uSzerep'] == "3") {
            $_SESSION['szerep'] = "edzo";
        }

        $email = $row['uemail'];

        $isBanned = "SELECT * FROM megbizhato WHERE megUID = '$uid' AND megIP = '$ip' AND megBan = '1'";
        if (sqlcall($isBanned)->num_rows > 0) {
            hibaUzenet("A fiókodat letiltották!");
            exit();
        }

        $sql_check_ip = "SELECT * FROM megbizhato WHERE megIP = '$ip' AND megStatus = '1'";
        $result_ip = sqlcall($sql_check_ip);

        if ($result_ip->num_rows == 0) {
            $token = bin2hex(random_bytes(32));
            $sql_insert_token = "INSERT INTO megbizhato (megUID, megIP, megDatum, megStatus, megToken, megEmail) 
                                 VALUES ('$uid', '$ip', '$curdate', '$curdate', '$token', '$email')";
            sqlsave($sql_insert_token);

            $confirm_link = "https://liftzone.hu/actions/ip_megerosites.php/?token=$token";
            $ban_ip = "https://liftzone.hu/actions/ip_megerosites.php/?ip=$ip&uid=$uid";
            sendMail($email, "bejelentkezesUj", $confirm_link, $ban_ip);
        }
        formSuccess();

    } else {
        hibaUzenet("Helytelen belépési adatok!!");
        exit();
    }
}