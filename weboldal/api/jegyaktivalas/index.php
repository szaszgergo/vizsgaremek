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

    if (!isset($input['uID']) || !isset($input['jID'])) {
        valaszKuldes(400, 'Hiányzó paraméter: uID, jID');
    }

    $uID = $input['uID'];
    $jID = $input['jID'];

    $jegylekerdezes = "SELECT * FROM jegyek WHERE juID = '$uID' AND jStatus = 1";
    $tabla = sqlcall($jegylekerdezes);
    $jegy = $tabla->fetch_assoc();

    if (isset($jegy)){
        valaszKuldes(400, 'Van aktív jegyed!');
    }


    $datum = date("Y-m-d H:i:s");

    $jtid = sqlcall("SELECT jtID FROM jegyek WHERE jID = $jID")->fetch_assoc()["jtID"];
    $hossz = sqlcall("SELECT tpHossz FROM tipusok WHERE tpID = $jtid")->fetch_assoc()["tpHossz"];
    
    $lejarat = date("Y-m-d H:i:s", strtotime($datum . " + $hossz days"));
    
    $sql = "UPDATE jegyek SET jStatus = 1, jKezdes = '$datum', jLejarat = '$lejarat' WHERE jID = $jID AND juID = $uID";
    sqlcall($sql);

    valaszKuldes(200, 'Sikeres aktiválás');

?>
