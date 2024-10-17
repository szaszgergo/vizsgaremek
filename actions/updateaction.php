<?php
require("sqlcall.php");
session_start();
$kepnev=$_SESSION['uid']."_".date("ymdHis")."_".uniqid('', more_entropy: true); //api kell majd
$kepadat=$_FILES['upic'];
$vankep = $_FILES['upic']['size'] > 0;
if ($vankep) {
    if($kepadat['type']=='image/jpeg') $kiterj=".jpg";else
    if($kepadat['type']=='image/png') $kiterj=".png";else
    if($kepadat['type']=='image/gif') $kiterj=".gif";else{
    $_SESSION['hiba'] = "A kép csak .JPG, vagy .PNG, vagy .GIF formátumú lehet!";
    echo "<script>
        window.top.postMessage({updateError: '" . $_SESSION['hiba'] . "'}, '*');
    </script>";
    die();}
    $kepnev.= $kiterj;
    move_uploaded_file($kepadat['tmp_name'],"../profile_pic/".$kepnev);
    $og_pic=$kepadat['name'];
}


if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["date"])) {
    //form adatok lekérdezési a POST-ból
    $email = $_POST["email"];
    $date =  $_POST["date"];

    //sql insert statement osszerakása
    $sql = "UPDATE user SET uemail = '$email', uSzuletesidatum = '$date'";
    if ($vankep) {
        $sql .= ", uProfilePic='$kepnev', uOriginPic='$og_pic' WHERE uid = $_SESSION[uid] ";
    } else{
        $sql .=  "WHERE uid = $_SESSION[uid] ";
    }
    //sql meghivása
    sqlsave($sql);
    echo "<script>window.top.postMessage({updateSuccess: true}, '*');</script>";
}




