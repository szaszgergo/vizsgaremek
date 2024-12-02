<?php

require('actions/naplozas.php');
require('actions/apicall.php');
require('actions/getuserinfo.php');
require('actions/getjegytipusadatok.php');

$cimek = [
    "arak" => "Áraink | LiftZone",
    "fiok" => "Fiókod | LiftZone",
    "jegyvasarlasform" => "Jegy vásárlása | LiftZone",
    "jelszomodositasform" => "Jelszó módosítása | LiftZone",
    "loginform" => "Bejelentkezés | LiftZone",
    "registerform" => "Regisztráció | LiftZone",
    "adatvedelem" => "Adatvédelem | LiftZone",
    "faqs" => "Gyakran ismételt kérdések | LiftZone",
    "hazirend" => "Házirend | LiftZone",
    "edzok" => "Személyi Edzőink | LiftZone",
    "galeria" => "Galéria | LiftZone",
    "admin" => "Admin Kezelőfelület  | LiftZone",
    "shop" => "Bolt | LiftZone",
    "" => "Főoldal | LiftZone",
];

$belepettoldalak = [
    "arak" => "oldalak/arak.php",
    "fiok" => "oldalak/fiok.php",
    "jegyvasarlasform" => "oldalak/jegyvasarlasform.php",
    "jelszomodositasform" => "oldalak/jelszomodositasform.php",
    "adatvedelem" => "oldalak/adatvedelem.php",
    "faqs" => "oldalak/faqs.php",
    "hazirend" => "oldalak/hazirend.php",
    "edzok" => "oldalak/edzok.php",
    "edzokall" => "oldalak/edzokall.php",
    "galeria" => "oldalak/galeria.php",
    "admin" => "oldalak/admin.php",
    "shop" => "oldalak/webshop.php",
    "termek" => "oldalak/termek.php",
    "" => "oldalak/main.php",
];

$oldalak = [
    "arak" => "oldalak/arak.php",
    "loginform" => "oldalak/loginform.php",
    "registerform" => "oldalak/registerform.php",
    "adatvedelem" => "oldalak/adatvedelem.php",
    "faqs" => "oldalak/faqs.php",
    "hazirend" => "oldalak/hazirend.php",
    "admin" => "oldalak/admin.php",
    "edzok" => "oldalak/edzok.php",
    "edzokall" => "oldalak/edzokall.php",
    "galeria" => "oldalak/galeria.php",
    "shop" => "oldalak/webshop.php",
    "termek" => "oldalak/termek.php",
    "" => "oldalak/main.php",
];

$o = $_GET['o'] ?? "";
$a = $_GET['a'] ?? "";
$cim = $cimek[$o] ?? "404 | LiftZone";

?>

<!DOCTYPE html>
<html lang="hu">

    <head>
        <base href="/" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <title><?= htmlspecialchars($cim) ?></title>
    </head>

    <body>
        <div class="site">
            <?php
            naplo();
            require('actions/language.php');
            require('oldalak/navbar.php');
            ?>

            <div class="content">
                <?php
                $belepett = !empty($_SESSION["uid"]);
                $pages = $belepett ? $belepettoldalak : $oldalak;

                if (isset($pages[$o])) {
                    require($pages[$o]);
                } else {
                    require("oldalak/404.php");
                }

                // print_r($_SESSION);
                ?>
            </div>

            <?php require('oldalak/footer.php'); ?>
        </div>

        <iframe name='kisablak' style="display: none;"></iframe>

        <?php
        $popups = [
            'jegyvasarlasform' => [
                "oldalak/popups/jegy_vasarlas_popup.php",
                "oldalak/popups/kartya_informacio_popup.php"
            ],
            'fiok' => [
                "oldalak/popups/vasarlasi_elozmeny_popup.php"
            ],
            'shop' => [
                "oldalak/popups/kosar.php"
            ]
        ];

        $adminPopups = [
            'kupon_kezeles' => ["oldalak/admin/popups/uj_kupon.php"],
            'termek_kezeles' => ["oldalak/admin/popups/uj_termek.php"]
        ];

        if (isset($popups[$o])) {
            foreach ($popups[$o] as $popup) {
                require($popup);
            }
        }

        if (isset($adminPopups[$a])) {
            foreach ($adminPopups[$a] as $popup) {
                require($popup);
            }
        }
        ?>

        <script>
            window.addEventListener('message', function (event) {
                const data = event.data;
                const errorMessage = document.getElementById('error-message');

                if (data.loginError) {
                    errorMessage.innerHTML = data.loginError;
                    errorMessage.style.display = 'block';
                } else if (data.loginSuccess) {
                    errorMessage.style.display = 'none';
                    window.location.href = "./?o=fiok";
                } else if (data.purchaseSuccess) {
                    window.location.href = "./?o=fiok";
                } else if (data.purchaseError) {
                    errorMessage.innerHTML = data.updateError;
                    errorMessage.style.display = 'block';
                }
                else if (data.success) {
                    document.getElementById('success-message').innerText = data.success;
                    document.getElementById('success-message').style.display = 'block';
                }
                else if (data.regSuccess) {
                    errorMessage.style.display = 'none';
                    window.location.href = "./?o=loginform";
                    alert('Sikeres regisztráció, lépj be!');
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="js/pic_change.js"></script>
        <script src="js/jegyvasarlas.js"></script>
        <script src="js/language.js"></script>
        <script src="js/sponsor-slide.js"></script>
        <script src="js/edit.js"></script>
    </body>

</html>
