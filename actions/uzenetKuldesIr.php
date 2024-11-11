<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Nem megfelelő email cím!'); window.location.href='oldalak/main.php';</script>";
        exit();
    }
    if (empty($_POST["message"])) {
        echo "<script>alert('Hiányzik az üzenet!'); window.location.href='oldalak/main.php';</script>";
        exit();
    }
    else{
        echo "<script>alert('Sikeres üzenetküldés!');</script>";

        $_SESSION["emailKuldes"] = $_POST["email"];
        $_SESSION["uzenetKuldes"] = $_POST["message"];
    
        echo "<script>window.top.postMessage({Success: true}, '*');</script>";
    
        exit();
    }
}
?>