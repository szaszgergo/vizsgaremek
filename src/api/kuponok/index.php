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

    $kuponoklekerdezes = "SELECT * FROM kuponok";
    $kuponok = sqlcall($kuponoklekerdezes);
    $kuponokarray = [];
    while ($row = $kuponok->fetch_assoc()) {
        $kuponokarray[] = $row;
    }

    $valasz = [
        'kuponok' => $kuponokarray
    ];

    valaszKuldes(200, 'Sikeres', $valasz);

?>
