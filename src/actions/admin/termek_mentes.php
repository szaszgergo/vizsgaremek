<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Only POST requests are allowed.";
    exit;
}

require('../sqlcall.php');
require("../formhandling.php");

$teNev = isset($_POST['teNev']) ? trim($_POST['teNev']) : null;
$teAr = isset($_POST['teAr']) ? floatval($_POST['teAr']) : null;
$teLeiras = isset($_POST['teLeiras']) ? trim($_POST['teLeiras']) : null;

if (empty($_FILES['teKepek']['name'][0])) {
    hibaUzenet("Képek feltöltése kötelező!");
    exit;
}

if (!$teNev || !$teAr || !$teLeiras) {
    hibaUzenet("Minden mezőt tölts ki!");
    exit;
}

$sql = "
    INSERT INTO termekek (teNev, teAr, teLeiras)
    VALUES ('$teNev', $teAr, '$teLeiras')
";

sqlcall($sql);

$idQuery = sqlcall("SELECT teID FROM termekek WHERE teNev = '$teNev' ORDER BY teID DESC LIMIT 1");
$newProductId = $idQuery->fetch_assoc()['teID'];

$targetDir = "../../images/termekek/$newProductId/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

foreach ($_FILES['teKepek']['tmp_name'] as $index => $tmpName) {
    $fileName = basename($_FILES['teKepek']['name'][$index]);
    $targetFile = $targetDir . "main.png";
    move_uploaded_file($tmpName, $targetFile);
}

echo "<script>if(window.parent){window.parent.location.reload();}</script>";

exit;
?>