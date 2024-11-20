<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Only POST requests are allowed.";
    exit;
}

require('../sqlcall.php');

$teNev = isset($_POST['teNev']) ? trim($_POST['teNev']) : null;
$teAr = isset($_POST['teAr']) ? floatval($_POST['teAr']) : null;
$teLeiras = isset($_POST['teLeiras']) ? trim($_POST['teLeiras']) : null;

if (!$teNev || !$teAr || !$teLeiras) {
    echo "Missing required fields. All fields must be filled.";
    exit;
}

$sql = "
    INSERT INTO termekek (teNev, teAr, teLeiras)
    VALUES ('$teNev', $teAr, '$teLeiras')
";

sqlcall($sql);

$idQuery = sqlcall("SELECT teID FROM termekek WHERE teNev = '$teNev' ORDER BY teID DESC LIMIT 1");
$newProductId = $idQuery->fetch_assoc()['teID'];

if (!empty($_FILES['teKepek']['name'][0])) {
    $targetDir = "../../images/termekek/$newProductId/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['teKepek']['tmp_name'] as $index => $tmpName) {
        $fileName = basename($_FILES['teKepek']['name'][$index]);
        $targetFile = $targetDir . $fileName;
        move_uploaded_file($tmpName, $targetFile);
    }
}

echo "Product added successfully.";
exit;
?>
