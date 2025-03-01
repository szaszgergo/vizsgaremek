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

    $jegyeklekerdezes = "SELECT * FROM tipusok";
    $jegyek = sqlcall($jegyeklekerdezes);
    $jegyekarray = [];
    while ($row = $jegyek->fetch_assoc()) {
        $jegyekarray[] = $row;
    }

    $valasz = [
        'tipusok' => $jegyekarray
    ];

    valaszKuldes(200, 'Sikeres', $valasz);

?>
