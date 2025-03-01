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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        valaszKuldes(405, 'Csak POST kérés engedélyezett');
    }

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    if (!isset($input['username']) || !isset($input['password'])) {
        valaszKuldes(400, 'Hiányzó paraméter: username, password');
    }

    $name = $input['username'];
    $password = $input['password'];
    
    // SQL query to find user by username or email
    $sqllekerdezes = "SELECT uID, uPassword FROM user WHERE uFelhasznalonev = '$name' OR uemail = '$name'";
    $tabla = sqlcall($sqllekerdezes);
    
    $sor = $tabla->fetch_row();

    if (!$sor) {
        valaszKuldes(404, 'Hibás bejelentkezési adatok');
    }

    $hashedpassword = $sor[1];
    if (!password_verify($password, $hashedpassword)) {
        valaszKuldes(404, 'Hibás jelszó');
    }

    $valasz = [
        'uID' => $sor[0]
    ];
    valaszKuldes(200, 'A bejelentkezés megtörtént!', $valasz);

    $curdate  = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $sessionid = session_id();

    $sql = "INSERT INTO login (lDatum, lIP, lSession, luID) VALUES (?, ?, ?, ?)";
    sqlsave($sql, [$curdate, $ip, $sessionid, $sor[0]]);
?>
