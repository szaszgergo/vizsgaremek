<?php
require_once 'sqlcall.php'; // Betöltjük az sqlcall.php fájlt

$eid = $_GET['eid'];

if (!$eid) {
    http_response_code(400);
    echo json_encode(['error' => 'Hiányzó edző azonosító (eid)!']);
    exit;
}

// SQL lekérdezés az idopontok lekérésére az aktuális edző alapján
$sql = "SELECT fo_idopont FROM edzok_foglalas WHERE foEID = ?";
$result = sqlcall($sql, 'i', [$eid]);  // Az 'eid' változó használata

// Az eredményeket tömbbe gyűjtjük
$idopontok = [];
while ($row = $result->fetch_assoc()) {
    $idopontok[] = $row['fo_idopont'];
}

// JSON formátumban visszaadjuk az eredményeket
header('Content-Type: application/json');
echo json_encode($idopontok);

?>
