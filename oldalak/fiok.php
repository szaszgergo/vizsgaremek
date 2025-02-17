<?php
$adatok = getUserInfo();
$jegy = getUserJegy();
$hasTicket = isset($jegy);
?>

<div class="row fiokrow">
    <?php
    require("fiok/felhasznalo_aktiv_jegye.php");
    require("fiok/felhasznalo_adatok.php");
    require("fiok/felhasznalo_kosarak.php");
    ?>
</div>
<div class="row fiokrow">
    <?php require("fiok/felhasznalo_jegyei.php"); ?>
</div>