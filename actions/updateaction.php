<?php
session_start();
require("sqlcall.php");
require("formhandling.php");

$kepnev=$_SESSION['uid']."_".date("ymdHis")."_".uniqid('', more_entropy: true); //api kell majd
$kepadat=$_FILES['upic'];
$vankep = $_FILES['upic']['size'] > 0;
if ($vankep) {
    if($kepadat['type']=='image/jpeg') $kiterj=".jpg";else
    if($kepadat['type']=='image/png') $kiterj=".png";else
    if($kepadat['type']=='image/gif') $kiterj=".gif";else{
    hibaUzenet("A kép csak .JPG, vagy .PNG, vagy .GIF formátumú lehet!");
    die();}
    $kepnev.= $kiterj;
    move_uploaded_file($kepadat['tmp_name'],"../profile_pic/".$kepnev);
    $og_pic=$kepadat['name'];
}


if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["date"])) {
    $email = $_POST["email"];
    $date =  $_POST["date"];

    checkEmail($email, true);

    $sql = "UPDATE user SET uemail = '$email', uSzuletesidatum = '$date'";
    if ($vankep) {
        $sql .= ", uProfilePic='$kepnev', uOriginPic='$og_pic' WHERE uid = $_SESSION[uid] ";
    } else{
        $sql .=  "WHERE uid = $_SESSION[uid] ";
    }
    sqlsave($sql);
    formSuccess();

    
}




