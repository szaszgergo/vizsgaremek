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

    if (!isset($input['uID']) || !isset($input['tpID'])) {
        valaszKuldes(400, 'Hiányzó paraméter: uID, tpID');
    }

    $uID = $input['uID'];
    $jtID = $input['tpID'];

    
    $sql = "INSERT INTO jegyek (jUID, jtID, jStatus) VALUES ($uID, $jtID, 2)";
    sqlcall($sql);

    valaszKuldes(200, 'Sikeres vásárlás');

?>
