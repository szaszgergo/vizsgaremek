<?php
session_start();
require("sqlcall.php");
require("formhandling.php");
require("mail.php");

// CAPTCHA generálása
function generateCaptcha()
{
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
        hibaUzenet("Nem sikerült az összeadásod!", $szam1, $szam2);
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

    $sql = "INSERT INTO user (uUID, uFelhasznalonev, uemail, uPassword, uSzuletesidatum, uRegisztracio, uIP, uSession, uStatus, uKomment, uSzerep)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'a', '.', 1)";

    sqlsave($sql, 'ssssssss', [$uuid, $username, $email, $password, $date, $curdate, $ip, $sessionid]);

    sendMail($email, "Sikeres regisztáció!", "Köszönjük hogy csatlakoztál a LiftZonehoz!");

    echo "<script>window.top.postMessage({regSuccess: true}, '*');</script>";
}
