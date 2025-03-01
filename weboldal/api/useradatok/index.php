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

    if (!$useradatok) {
        valaszKuldes(404, 'A felhasználót nem találtuk!');
    }

    function JegyLekerdezesStatusAlapjan($uid, $status){
        $sql = "SELECT * FROM jegyek WHERE juID = ? AND jStatus = ?";
        $jegyek = sqlcall($sql, "si", [$uid, $status]);
        $jegyekarray = [];
    
        while ($row = $jegyek->fetch_assoc()) {
            $row['jNev'] = getJegyTipusAdatok($row['jtID'])['tpNev'];
            $jegyekarray[] = $row;
        }
    
        return $jegyekarray;
    }

    $jegyek = JegyLekerdezesStatusAlapjan($uid, 0);
    $aktivjegy = JegyLekerdezesStatusAlapjan($uid, 1);
    $aktivalhato_jegyek  = JegyLekerdezesStatusAlapjan($uid, 2);

    $valasz = [
        'user' => $useradatok,
        'jegyek' => $jegyek,
        'aktivjegy' => $aktivjegy ? [$aktivjegy[0], $aktivjegy[0]['jNev']] : null,
        'aktivalhato_jegyek' => $aktivalhato_jegyek
    ];

    valaszKuldes(200, 'Sikeres lekérdezés', $valasz);

?>
