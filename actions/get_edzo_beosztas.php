<?php
require_once 'sqlcall.php'; // Betöltjük az sqlcall.php fájlt

$eid = $_GET['eid'];

if (!$eid) {
    http_response_code(400);
    echo json_encode(['error' => 'Hiányzó edző azonosító (eid)!']);
    exit;
}

// SQL lekérdezés az idopontok lekérésére az aktuális edző alapján
$sql = "SELECT eb_idopont, eb_Status FROM edzo_beosztas WHERE ebEID = ?";
$result = sqlcall($sql, 'i', [$eid]);  // Az 'eid' változó használata

// Az eredményeket tömbbe gyűjtjük
$idopontok = [];
while ($row = $result->fetch_assoc()) {
    // Időpont és státusz összefűzése egy stringbe
    $idopontok[] = $row['eb_idopont'] . ' ' . $row['eb_Status'];
}

// JSON formátumban visszaadjuk az eredményeket
header('Content-Type: application/json');
echo json_encode($idopontok);
?>
