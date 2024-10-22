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
    if (!isset($_GET['username']) || !isset($_GET['password'])) {
        valaszKuldes(400, 'Hiányzó paraméter: username, password');
    }

    $name = $_GET['username'];
    $password = $_GET['password'];
    
    $sqllekerdezes = "SELECT uID, uPassword FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    
    $sor = $tabla->fetch_row();
    //ha nincs result válasz és kilépés
    if (!isset($sor)) {
        valaszKuldes(404, 'Hibás bejelentkezési adatok');
    }
    //ha nem egyezik a jelszó küldés és kilépés
    $hashedpassword = $sor[1];
    if(!password_verify($password, $hashedpassword)){
        valaszKuldes(404, 'Hibás jelszó');
    }

    //ha ide eljutott akkor minden fain, visszaküldjük az id-t és ezt majd az oldalon vagy a mobilon sessionbe rakjuk
    $valasz = [
        'uID' => $sor[0]
    ];

    valaszKuldes(200, 'A bejelentkezés megtörtént!', $valasz);

    $curdate  = date('Y-m-d h:i:s', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    $sessionid = session_id();
    $url = $_SERVER['REQUEST_URI'];
    $sql = "INSERT INTO login (lID, lDatum, lIP, lSession, luID) VALUES
    ('', '$curdate', '$ip', '$sessionid', '$sor[0]')";
    sqlsave($sql);

?>
