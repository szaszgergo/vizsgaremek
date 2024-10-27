<?php
session_start();
require("sqlcall.php");
require("formhandling.php");

// CAPTCHA generálása
function generateCaptcha() {
    $szam1 = rand(1, 9);
    $szam2 = rand(1, 9);
    $_SESSION['eredmeny'] = $szam1 + $szam2;
    return [$szam1, $szam2];
}


// Beviteli mezők ellenőrzése
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    checkField("username", "Hiányzik a felhasználónév!");
    checkField("date", "Hiányzik a születési dátum!");

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        hibaUzenet("Nem megfelelő email cím!");
    }

    checkPassword($_POST["password"]);

    if ($_POST["password"] !== $_POST["retype_password"]) {
        hibaUzenet("A jelszavaknak egyezniük kell!");
    }

    if ($_POST["user_eredmeny"] != $_SESSION["eredmeny"]) {
        list($szam1, $szam2) = generateCaptcha(); 
        hibaUzenet("Nem sikerült az összeadásod!");
        exit();
    }

    // Form adatok lekérése
    $username = $_POST["username"];
    $email = $_POST["email"];
    $date = $_POST["date"];

    checkEmail($email);
    // Jelszó hashelése és adatok mentése
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $curdate = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $sessionid = session_id();
    $uuid = uniqid('', true);

    $sql = "INSERT INTO user (uUID, uFelhasznalonev, uemail, uPassword, uSzuletesidatum, uRegisztracio, uIP, uSession, uStatus, uKomment)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'a', '.')";

    sqlsave($sql, 'ssssssss', [$uuid, $username, $email, $password, $date, $curdate, $ip, $sessionid]);

    echo "<script>window.top.postMessage({regSuccess: true}, '*');</script>";
    }
?>



<?php
/*
require("sqlcall.php");

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["date"]) && isset($_POST["password"])) {
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
        $uuid = uniqid('', more_entropy: true);
        //sql insert statement osszerakása
        $sql = "INSERT INTO user (uID, uUID, uFelhasznalonev, uemail, uPassword, uSzuletesidatum, uRegisztracio, uIP, uSession, uStatus, uKomment)
        VALUES ('', '$uuid', '$username', '$email', '$password', '$date', '$curdate', '$ip', '$sessionid', 'a', '.')";
        //sql meghivása
        sqlsave($sql);
        echo "<script>window.top.postMessage({regSuccess: true}, '*');</script>";
    }

}
*/
?>