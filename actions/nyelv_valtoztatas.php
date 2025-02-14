<?php
session_start();
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'hu';

$_SESSION['lang'] = $lang;

// Visszairányítás az előző oldalra
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
