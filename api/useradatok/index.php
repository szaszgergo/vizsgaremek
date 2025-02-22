<?php
    header('Content-Type: application/json; charset=utf-8');
    include("../../actions/sqlcall.php");
    function getJegyTipusAdatok($tipus) {
        $sql = "SELECT * FROM tipusok WHERE tpID = $tipus";
        $sor = sqlcall($sql)->fetch_assoc();
        return $sor;
    }
    function valaszKuldes($status, $uzenet, $data = []) {
        echo json_encode(array(
            'status' => $status,
            'uzenet' => $uzenet,
            'data' => $data
        ), JSON_UNESCAPED_UNICODE);
        exit;
    }

    //ha nincs megadva a paraméter küldés és kilépés
    if (!isset($_GET['uid'])) {
        valaszKuldes(400, 'Hiányzó paraméter: uid');
    }

    $uid = $_GET['uid'];

    $userlekerdezes = "SELECT * FROM user WHERE uID = '$uid'";
    $user = sqlcall($userlekerdezes);
    $useradatok = $user->fetch_assoc();

    //ha nincs találat küldés és kilépés
    if (!$useradatok) {
        valaszKuldes(404, 'A felhasználót nem találtuk!');
    }
    $jegyeklekerdezes = "SELECT * FROM jegyek WHERE juID = '$uid'";
    $jegyek = sqlcall($jegyeklekerdezes);
    $jegyekarray = [];

    //nevek hozzáadása a jegyekhez
    while ($row = $jegyek->fetch_assoc()) {
        $row['jNev'] = getJegyTipusAdatok($row['jtID'])['tpNev'];
        $jegyekarray[] = $row;
    }

    $aktivjegysql = "SELECT * FROM jegyek WHERE juID = '$uid' AND jStatus = 1";
    $aktivjegy = sqlcall($aktivjegysql)->fetch_assoc();
    $aktivjegyneve = getJegyTipusAdatok($aktivjegy['jtID'])['tpNev'];




    $valasz = [
        'user' => $useradatok,
        'aktivjegy' => [$aktivjegy, $aktivjegyneve],
        'jegyek' => $jegyekarray
    ];

    valaszKuldes(200, 'Sikeres lekérdezés', $valasz);

?>
