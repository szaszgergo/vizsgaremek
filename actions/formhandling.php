<?php
function hibaUzenet($uzenet) {
    echo "<script> window.top.postMessage({loginError: '" . $uzenet . "'}, '*'); </script>";
    exit();
}

function formSuccess(){
    echo "<script>window.top.postMessage({loginSuccess: true}, '*');</script>";
    exit();
}

function checkField($field, $message) {
    if (empty($_POST[$field])) {
        hibaUzenet($message);
    }
}

function checkEmail($email){
    // Email foglaltság ellenőrzése
    $sqllekerdezes = "SELECT uID FROM user WHERE uemail = ?";
    $tabla = sqlcall($sqllekerdezes, 's', [$email]);
    $row = $tabla->fetch_row();
    if($row){hibaUzenet("Ez az email cím már foglalt!");};
}

function checkPassword($password) {
    if (strlen($password) < 8) {
        hibaUzenet("Legalább 8 karakter kell hogy legyen a jelszó!");
    }
    if (!preg_match("/[a-z]/i", $password)) {
        hibaUzenet("Legalább egy betűt tartalmaznia kell a jelszónak!");
    }
    if (!preg_match("/[0-9]/", $password)) {
        hibaUzenet("Legalább egy számot tartalmaznia kell a jelszónak!");
    }
 }



?>