<?php

//requireok
require('actions/apicall.php');
require('actions/getuserinfo.php');
require('actions/getjegytipusadatok.php');
//bövithető lista az uj oldalak cimeihez 
$cimek = [
    "arak" => "Áraink - LiftZone",
    "fiok" => "Fiókod - LiftZone",
    "jegyvasarlasform" => "Jegy vásárlása - LiftZone",
    "jelszomodositasform" => "Jelszó módosítása - LiftZone",
    "loginform" => "Bejelentkezés - LiftZone",
    "registerform" => "Regisztráció - LiftZone",
    "adatvedelem" => "Adatvédelem - LiftZone",
    "faqs" => "Gyakran ismételt kérdések - LiftZone",
    "hazirend" => "Házirend - LiftZone",
    "edzok"=> "Személyi Edzőink",
    "" => "Főoldal - LiftZone",
];
$belepettoldalak = [
    "arak" => "oldalak/arak.php",
    "fiok" => "oldalak/fiok.php",
    "jegyvasarlasform" => "oldalak/jegyvasarlasform.php",
    "jelszomodositasform" => "oldalak/jelszomodositasform.php",
    "adatvedelem" => "oldalak/adatvedelem.php",
    "faqs" => "oldalak/faqs.php",
    "hazirend" => "oldalak/hazirend.php",
    "edzok"=> "oldalak/edzok.php",
    "" => "oldalak/main.php",
];

$oldalak = [
    "arak" => "oldalak/arak.php",
    "loginform" => "oldalak/loginform.php",
    "registerform" => "oldalak/registerform.php",
    "adatvedelem" => "oldalak/adatvedelem.php",
    "faqs" => "oldalak/faqs.php",
    "hazirend" => "oldalak/hazirend.php",
    "edzok"=> "oldalak/edzok.php",
    "" => "oldalak/main.php",
];

$o = isset($_GET['o']) ? $_GET['o'] : "";
if (array_key_exists($o, $cimek)) {
    $cim = $cimek[$o];
} else {
    $cim = "404 - LiftZone";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sponsor_slider.css">

    <title><?=$cim?></title>
</head>
<body>
    <div class="site">
        <?php require('actions/naplozas.php'); naplo(); ?>
        <?php include('actions/language.php'); ?>
        <?php require('oldalak/navbar.php'); ?>
        <?php require('oldalak/footer.php'); ?>


        <div class="content">
        <?php
            $belepett = isset($_SESSION["uid"]);

            //belepett vagy a sima oldalak listajat hasznaljuk
            $pages = $belepett ? $belepettoldalak : $oldalak;

            //link alapjan require
            if (array_key_exists($o, $pages)) {
                require($pages[$o]);
            } else {
                require("oldalak/404.php");
            }
            //debug kiiratás
            print_r($_SESSION);
            ?>
    
        </div>

      
    </div>
    <iframe name='kisablak' style="display: none;"></iframe>


   
    <?php require("oldalak/jegyvasarlaspopup.php")?>
    <?php require("oldalak/kartyaformpopup.php")?>

    <script>
        //majd ezt a hibakezelést is megcsinálom -gabor
        window.addEventListener('message', function(event) {
            if (event.data.loginError) {
                document.getElementById('error-message').innerHTML = event.data.loginError;
                document.getElementById('error-message').style.display = 'block';
            }
            if (event.data.loginSuccess) {
                document.getElementById('error-message').style.display = 'none';
                window.location.href = "./?o=fiok";
            }
            if (event.data.purchaseSuccess) {
                window.location.href = "./?o=fiok";
            }
            if (event.data.purchaseError) {
                document.getElementById('error-message').innerHTML = event.data.updateError;
                document.getElementById('error-message').style.display = 'block';
            }
            if (event.data.regSuccess) {
                document.getElementById('error-message').style.display = 'none';
                window.location.href = "./?o=loginform";
                alert('Sikeres regisztráció, lépj be!');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="js/pic_change.js"></script>
    <script src="js/jegyvasarlas.js"></script>
    <script src="js/language.js"></script>
    <script src="js/sponsor-slide.js"></script>


</body>
</html>
