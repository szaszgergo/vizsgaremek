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


    if (!isset($input['uID']) || !isset($input['ertTipus']) || !isset($input['ertDatum'])) {
        valaszKuldes(400, 'Hiányzó paraméter: uID, ertTipus, ertDatum');
    }

    $uid = $input['uID'];
    $datum = $input['ertDatum'];
    $tipus = $input['ertTipus'];

    $sql  = "INSERT INTO `ertesites` ( ertuID, ertDatum, ertTipus, ertStatus) VALUES (?,?,?,?)";
    $result = sqlsave($sql, "issi", array($uid, $datum, $tipus, 0));

    if (!$result) {
        valaszKuldes(404, 'Hiba történt a mentés közben!');
    }



    valaszKuldes(200, 'Sikeres mentés');

?>
