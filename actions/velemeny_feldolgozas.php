<?php
require("sqlcall.php");
if (isset($_POST["accept"])) {
    $ekID = $_POST["ekID"];
    $sql = "UPDATE edzok_kommentek SET ek_Status = ? WHERE ekID = ?";
    $params = [1, $ekID];
    $types = "ii";
    sqlsave($sql, $types, $params);
    echo "<script>
            alert('Vélemény elfogadva!');
            window.location.href = '" . ($_SERVER['HTTP_REFERER'] ?? 'index.php') . "';
          </script>";
    exit();
}

if (isset($_POST["deny"])) {
    $ekID = $_POST["ekID"];
    $sql = "UPDATE edzok_kommentek SET ek_Status = ? WHERE ekID = ?";
    $params = [0, $ekID];
    $types = "ii";
    sqlsave($sql, $types, $params);
    echo "<script>
            alert('Vélemény elutasítva!');
            window.location.href = '" . ($_SERVER['HTTP_REFERER'] ?? 'index.php') . "';
          </script>";
    exit();
}
?>