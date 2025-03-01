<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'sqlcall.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["timerange"])) {
    $timerange = $_POST["timerange"];

    if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] === "edzo") {
        $sql = "SELECT szeID FROM szemelyi_edzok WHERE szeUID = ?";
        $result = sqlcall($sql, 'i', [$_SESSION["uid"]]);

        if ($row = $result->fetch_row()) {
            $szeID = $row[0];

            $sql2 = "SELECT ebUID FROM edzo_beosztas WHERE ebEID = ? AND eb_Status=1 AND eb_idopont = ?";
            $result2 = sqlcall($sql2, 'is', [$szeID, $timerange]);

            if ($row2 = $result2->fetch_assoc()) {
                $foUID = $row2["ebUID"];

                $sql3 = "SELECT uFelhasznalonev, uemail, uTelefon FROM user WHERE uid = ?";
                $result3 = sqlcall($sql3, 'i', [$foUID]);
                $user = $result3->fetch_assoc();

                if ($user) {
                    echo json_encode([
                        "success" => true,
                        "username" => $user["uFelhasznalonev"],
                        "email" => $user["uemail"],
                        "phone" => $user["uTelefon"],
                        "ebUID" => $foUID
                        
                    ]);
                    exit;
                }
            }
        }
    }
}

// Ha nem talál adatot
echo json_encode(["success" => false]);
?>
