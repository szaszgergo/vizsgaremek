<?php
include('actions/apicall.php');
include('actions/getuserinfo.php');
include('actions/getjegytipusadatok.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <?php
        $cim ="";
        if (isset($_GET['o'])) {
            $o = $_GET['o'];
            if ($o == "arak") {
                $cim = "Áraink - LiftZone";
            }
            else if ($o == "fiok") {
                $cim = "Fiókod - LiftZone";
            }
            else if ($o == "jegyvasarlasform") {
                $cim = "Jegy vásárlása - LiftZone";
            }
            else if ($o == "jelszomodositasform") {
                $cim = "Jelszó módosítása - LiftZone";
            }
            else if ($o == "loginform") {
                $cim = "Bejelentkezés - LiftZone";
            }
            else if ($o == "registerform") {
                $cim = "Regisztráció - LiftZone";
            }
            else if ($o == "adatvedelem") {
                $cim = "Adatvédelem - LiftZone";
            }
            else{
                $cim = "404 - LiftZone";
            }
        } else {
            $cim = "Főoldal - LiftZone";
        }
        
        ?>
    <title><?=$cim?></title>
</head>
<body>
    <div class="site">
    <?php include('actions/naplozas.php'); naplo(); ?>
    <nav class="navbar navbar-dark  bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand text-warning fs-2" href="./"><img src="images/logo.png" alt="LiftZone" title="LiftZone" class="logo"></a>
            <p id="nav_p" class="text-end" href="">4222 Budapest, Utca u. 117.</p>
            <p id="nav_p" class="text-end" href="" >6:00 - 23:00</p>
            <form class="d-flex align-items-center">
                <?php if (!isset($_SESSION["loggedin"])): ?>
                    <a class="btn btn-warning m-2" href="./?o=loginform">Bejelentkezés </a>
                    <a class="btn btn-warning m-2" href="./?o=registerform">Regisztráció</a>
                <?php else: ?>
                    <!-- Felhasználói profil információ -->
                    <span class="navbar-text">
                        <a href="./?o=fiok" id="felhasznalo_nev" class="d-flex align-items-center">
                            <?= getUserInfo()[2] ?>
                            <img alt="Profile Image" class="profile-image" src="profile_pic/<?= empty(getUserInfo()[11]) ? '../images/pic.png' : getUserInfo()[11] ?>"/>
                        </a>
                    </span>
                    <a href="actions/logout.php" class="btn btn-danger m-2">Kijelentkezés</a>
                <?php endif; ?>
                <!-- Hamburger ikon -->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="hamburgerMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hamburgerMenu">
                        <li><a class="dropdown-item" href="./?o=arak">Áraink</a></li>
                        <li><a class="dropdown-item" href="#">Edzők</a></li>
                        <li><a class="dropdown-item" href="#">Galéria</a></li>
                        <li><a class="dropdown-item" href="#">Gyakori kérdések</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </nav>
        <div class="content">
        <?php
            if (isset($_GET['o'])) {
                $o = $_GET['o'];
            } else{
                $o = "";
            }

            if (isset($_SESSION["uid"])) {
                if ($o == "arak") {
                    require("oldalak/arak.php");
                }
                else if ($o == "") {
                    require("oldalak/main.php");
                }
                else if ($o == "fiok") {
                    require("oldalak/fiok.php");
                }
                else if ($o == "jegyvasarlasform") {
                    require("oldalak/jegyvasarlasform.php");
                }
                else if ($o == "adatvedelem") {
                    require("oldalak/adatvedelem.php");
                }
                else if ($o == "jelszomodositasform") {
                    require("oldalak/jelszomodositasform.php");
                }
                else{
                    require("oldalak/404.php");
                }
            }
            else{
                if ($o == "arak") {
                    require("oldalak/arak.php");
                }
                else if ($o == "loginform") {
                    require("oldalak/loginform.php");
                }
                else if ($o == "registerform") {
                    require("oldalak/registerform.php");
                }
                else if ($o == "adatvedelem") {
                    require("oldalak/adatvedelem.php");
                }
                else if ($o == "") {
                    require("oldalak/main.php");
                }
                
                else{
                    require("oldalak/404.php");
                }
            }
            

            print_r($_SESSION);
            ?>
        </div>
    </div>
    <iframe name='kisablak' class="x"></iframe> <!-- hidden a class -->

    
   

            <div class="page-wrapper">
                <div class="page-content">
                </div>
       
        <footer class="footer">
            <div class="text p-3">
                <p><a class="text-warning" href="./?o=adatvedelem">Adatvédelmi tájékoztató</a></p>
                <a class="m-1" href="#"><i class="fa-brands fa-facebook-f"  style="font-size:24px"></i></a>
                <a class="m-1" href="#"><i class="fa-brands fa-instagram"  style="font-size:24px"></i></a>
                <a class="m-1" href="#"><i class="fa-brands fa-youtube"  style="font-size:24px"></i></a>
                <a class="m-1" href="#"><i class="fa-brands fa-tiktok"  style="font-size:24px"></i></a> 
                <p style="font-size: small; color: white;">Copyright © 2024 LiftZone edzőterem. Minden jog fenntartva.</p>

            </div>
        </footer>
    </div>
   
    <script>
        window.addEventListener('message', function(event) {
            if (event.data.loginError) {
                document.getElementById('error-message').innerHTML = event.data.loginError;
                document.getElementById('error-message').style.display = 'block';
            }
            if (event.data.loginSuccess) {
                document.getElementById('error-message').style.display = 'none';
                window.location.href = "./?o=fiok";
            }
            if (event.data.updateError) {
                document.getElementById('error-message').innerHTML = event.data.updateError;
                document.getElementById('error-message').style.display = 'block';
            }
            if (event.data.updateSuccess) {
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
    <script src="js/pic_change.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>