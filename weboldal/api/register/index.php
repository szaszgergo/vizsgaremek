<?php
    header('Content-Type: application/json; charset=utf-8');
    include("../../actions/sqlcall.php");
    function valaszKuldes($status, $uzenet, $data = []) {
        echo json_encode(array(
            'status' => $status,
            'uzenet' => $uzenet,
            'data' => $data
        ), JSON_UNESCAPED_UNICODE);
        exit;
    }

    //ha nincs megadva a paraméter küldés és kilépés
    if (!isset($_GET['username']) || !isset($_GET['password']) || !isset($_GET['email']) || !isset($_GET['date'])) {
        valaszKuldes(400, 'Hiányzó paraméter: username, password, email, date');
    }

    $name = $_GET['username'];
    $email = $_GET['email'];
    $date = $_GET['date'];
    
    $sqllekerdezes = "SELECT uID FROM user WHERE uemail = '$email'";
    $tabla = sqlcall($sqllekerdezes);
    $row = $tabla->fetch_row();
    //ha van eredmeny lekerdezesbe == van mar ilyen email
    if (isset($row)) {
        valaszKuldes(404, 'Ez az email már foglalt!');
    }

    //jelszo hashelése BLOWFISH algoritmussal
    $password = password_hash($_GET["password"], PASSWORD_BCRYPT);
    $curdate  = date('Y-m-d h:i:s', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    session_start();
    $sessionid = session_id();
    $uuid = uniqid('', true);
    // sql insert statement osszerakása
    $sql = "INSERT INTO user (uID, uUID, uFelhasznalonev, uemail, uPassword, uSzuletesidatum, uRegisztracio, uIP, uSession, uStatus, uKomment)
    VALUES ('', '$uuid', '$name', '$email', '$password', '$date', '$curdate', '$ip', '$sessionid', 'a', '.')";
    //sql meghivása
    sqlsave($sql);

    valaszKuldes(200, 'A regisztráció megtörtént!', '');

?>
