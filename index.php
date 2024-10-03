<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php
    $cim ="";
    if (isset($_GET["o"])){
        switch ($_GET["o"]) {
                case 'register':
                    $cim ="Regisztráció - LiftZone";
                    break;
                case 'login':
                    $cim ="Bejelentkezés - LiftZone";
                    break;
                case 'jegyvasarlas':
                    $cim ="Jegyvásárlás - LiftZone";
                    break;
                case 'arak':
                    $cim ="Árak - LiftZone";
                    break;
                default:
                    $cim ="404 Error";
                    break;
            }
        } else {
            $cim ="LiftZone";
        }?>
    <title><?=$cim?></title>
</head>
<body>
    <div class="site">
    <?php include('actions/naplozas.php'); naplo(); ?>
    <nav class="navbar navbar-dark  bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand text-warning fs-2" href="./">FitZone</a>
            <a class="text-end" href="">1214 Budapest, Kossuth L. u. 117.</a>
            <a class="text-end" href="">6:00 - 23:00</a>
            <form class="d-flex">
                <?php if (!isset($_SESSION["loggedin"])) {
                    echo '<a class="btn btn-warning m-2" href="./?o=login">Bejelentkezés</a><a class="btn btn-warning m-2" href="./?o=register">Regisztráció </a>';
                } else{
                    include("actions/getuserinfo.php");
                    $a = '
                    <span class="navbar-text"><a href="./?o=fiok" class=text-end">'.getUserInfo()[1].'</a></span>
                    <a href="actions/logout.php" class="btn btn-danger">Kijelentkezés</a>';
                    echo $a;
                }?>
            </form>
        </div>
    </nav>
        <div class="content">
            <?php
            if (isset($_GET["o"])) {
                if ($_GET["o"] == "register") {
                    require("oldalak/registerform.php");
                } elseif ($_GET["o"] == "login"){
                    require("oldalak/loginform.php");
                } elseif ($_GET["o"] == "jegyvasarlas"){
                    require("oldalak/jegyvasarlasform.php");
                } elseif ($_GET["o"] == "arak"){
                    require("oldalak/arak.php");
                } elseif ($_GET["o"] == "fiok"){
                    require("oldalak/fiok.php");
                }
                else{
                    echo "<br><h1>404</h1>";
                }
            } else{
                require("oldalak/main.php");
            }

        //ez alapjan majd dinamikusan
        //     <?php
        //     $directory = 'megoldasok/';
        //     $files = scandir($directory);
        //     foreach ($files as $file) {
        //         if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
        //             $fileNumber = preg_replace('/\D/', '', $file);
        //             echo '<tr>';
        //             echo '<td><a href="' . $directory.$file . '"> ' . $fileNumber . ' </a></td>' . PHP_EOL;
        //             echo '<td><a title="Forráskód" href="?src=' . $fileNumber . '">-></a></td>' . PHP_EOL;
        //             echo '<td><a target="_" title="Megnyitás az infojegyzet weboldalán" href="https://infojegyzet.hu/' . $fileNumber . '">-></a></td>' . PHP_EOL;
        //             echo '</tr>';
        //         }
        //     }
        // 

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
                window.location.href = "./";
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>
</html>