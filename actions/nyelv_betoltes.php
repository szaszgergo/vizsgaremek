<?php

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'hu';

$filePath = $lang === 'hu' ? './lang/lang_hu.json' : './lang/lang_en.json';

if (!file_exists($filePath)) {
    die("Error: Language file not found.");
}

$languageContent = json_decode(file_get_contents($filePath), true);
?>