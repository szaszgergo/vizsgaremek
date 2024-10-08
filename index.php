<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php
        $cim ="";

    $directory = 'oldalak/';
    $files = scandir($directory);

    $validPages = [];
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            $pageName = basename($file, '.php');
            $validPages[$pageName] = $directory . $file;
        }
    }

    if (isset($_GET['o'])) {
        $requestedPage = $_GET['o'];

        if (array_key_exists($requestedPage, $validPages)) {
            $cim ="$requestedPage - LiftZone";
        } else {
            $cim ="404 Error";
        }
    } else {
        $cim ="LiftZone";
    }
        
        ?>
    <title><?=$cim?></title>
</head>
<body>
    <div class="site">
    <?php include('actions/naplozas.php'); naplo(); ?>
    <nav class="navbar navbar-dark  bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand text-warning fs-2" href="./">LiftZone</a>
            <a class="text-end" href="">1214 Budapest, Kossuth L. u. 117.</a>
            <a class="text-end" href="">6:00 - 23:00</a>
            <form class="d-flex">
                <?php if (!isset($_SESSION["loggedin"])) {
                    echo '<a class="btn btn-warning m-2" href="./?o=loginform">Bejelentkezés</a>
                    <a class="btn btn-warning m-2" href="./?o=registerform">Regisztráció </a>';
                } else{
                    include("actions/getuserinfo.php");
                    include("actions/getjegytipusadatok.php");
                    $a = '
                    <span class="navbar-text"><a href="./?o=fiok" class=text-end">'.getUserInfo()[2].'<i class="fa fa-user-circle-o" style="font-size:36px"></i></a></span>
                    <a href="actions/logout.php" class="btn btn-danger">Kijelentkezés</a>';
                    echo $a;
                }?>
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
    <div class="footer">
        cuccok
    </div>
    <iframe name='kisablak' class="hidden"></iframe>
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
            if (event.data.regSuccess) {
                document.getElementById('error-message').style.display = 'none';
                window.location.href = "./?o=loginform";
                alert('Sikeres regisztráció, lépj be!');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>
</html>