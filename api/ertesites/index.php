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


    if (!isset($input['uID']) || !isset($input['jID']) || !isset($input['ertNappalElotte'])) {
        valaszKuldes(400, 'Hiányzó paraméter: uID, jID, ertNappalElotte');
    }

    $uid = $input['uID'];
    $datum = $input['ertNappalElotte']; // 7
    $jegy = $input['jID'];

    $jegylejarat = sqlcall("SELECT * FROM jegy WHERE jID = '$jegy' AND jStatus = 1");
    if ($jegylejarat->num_rows == 0) {
        valaszKuldes(404, 'A jegy nem létezik vagy lejárt!');
    }
    $lejarat = $jegylejarat->fetch_assoc()["jLejarat"];

    //lejarat - datum
    $ertesitesi_Datum = date('Y-m-d', strtotime($datum . ' - ' . $lejarat . ' days'));

    $sql  = "INSERT INTO `ertesites` ( ertuID, ertDatum, ertjID, ertStatus) VALUES (?,?,?,?)";
    $result = sqlsave($sql, "isii", array($uid, $ertesitesi_Datum, $jegy, 1));

    if (!$result) {
        valaszKuldes(404, 'Hiba történt a mentés közben!');
    }



    valaszKuldes(200, 'Sikeres mentés');

?>
