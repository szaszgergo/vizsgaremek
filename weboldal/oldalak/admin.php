<?php
if (!isset($_SESSION["szerep"]) || $_SESSION["szerep"] != "admin") {
    header("Location: index.php");
    exit();
} ?>


<div class="admin row bg-transparentblack">
    <div class="sidebar col-md-4 ">
        <h3 class="text-center text-white">Admin Kezelőfelület</h3>
        <?php 
        $currentPage = $_GET['a'] ?? '';?>
        <a href="?o=admin&a=felhasznalo_kezeles&search=" class="<?php echo ($currentPage === 'felhasznalo_kezeles') ? 'active' : ''; ?>">Felhasználok kezelése</a>
        <a href="?o=admin&a=edzo_kezeles" class="<?php echo ($currentPage === 'edzo_kezeles') ? 'active' : ''; ?>">Edzők kezelése</a>
        <a href="?o=admin&a=kupon_kezeles" class="<?php echo ($currentPage === 'kupon_kezeles') ? 'active' : ''; ?>">Kuponok kezelése</a>
        <a href="?o=admin&a=jegy_kezeles" class="<?php echo ($currentPage === 'jegy_kezeles') ? 'active' : ''; ?>">Jegy típusok kezelése</a>
        <a href="?o=admin&a=termek_kezeles" class="<?php echo ($currentPage === 'termek_kezeles') ? 'active' : ''; ?>">Termékek kezelése</a>
        <a href="?o=admin&a=statisztika" class="<?php echo ($currentPage === 'statisztika') ? 'active' : ''; ?>">Statisztika</a>
        <a href="?o=admin&a=messages" class="<?php echo ($currentPage === 'messages') ? 'active' : ''; ?>">Üzenetek</a>
        <a href="?o=admin&a=velemenyek" class="<?php echo ($currentPage === 'velemenyek') ? 'active' : ''; ?>">Vélemények</a>
        <a href="?o=admin&a=uzenofalAdmin" class="<?php echo ($currentPage === 'uzenofalAdmin') ? 'active' : ''; ?>">Üzenőfal</a>
    </div>

    <div class="main-content col-md-8">
        <?php
        $adminoldalak = [
            "felhasznalo_kezeles" => "oldalak/admin/felhasznalo_kezeles.php",   
            "edzo_kezeles" => "oldalak/admin/edzo_kezeles.php",
            "jegy_kezeles" => "oldalak/admin/jegy_kezeles.php",
            "termek_kezeles" => "oldalak/admin/termek_kezeles.php",
            "kupon_kezeles" => "oldalak/admin/kupon_kezeles.php",
            "statisztika" => "oldalak/admin/statisztika.php",
            "messages" => "oldalak/admin/messages.php",
            "velemenyek" => "oldalak/admin/velemenyek.php",
            "uzenofalAdmin" => "oldalak/admin/uzenofalAdmin.php",
        ];

        $a = isset($_GET['a']) ? $_GET['a'] : "";
        if (array_key_exists($a, $adminoldalak)) {
            require($adminoldalak[$a]);
        } else {
            require("oldalak/admin/felhasznalo_kezeles.php");
        }
        ?>
        
        
    </div>
</div>
