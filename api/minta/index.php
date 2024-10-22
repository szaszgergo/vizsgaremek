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
    if (!isset($_GET['parameter'])) {
        valaszKuldes(400, 'Hiányzó paraméter: parameter');
    }

    //ha nincs találat küldés és kilépés
    if (!$foo) {
        valaszKuldes(404, 'Az x nem találtuk!');
    }

    $valasz = [
        'x' => $x,
        'y' => $y
    ];

    valaszKuldes(200, 'Sikeres', $valasz);

?>
