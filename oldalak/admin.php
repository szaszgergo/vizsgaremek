<div class="admin">
    <div class="sidebar">
        <h3 class="text-center text-white">Admin Kezelőfelület</h3>
        <a href="?o=admin&a=felhasznalo_kezeles">Felhasználok kezelése</a>
        <a href="?o=admin&a=jegy_kezeles">Jegy tipsuok kezelése</a>
        <a href="?o=admin&a=kupon_kezeles">Kuponok kezelése</a>
        <a href="?o=admin&a=statisztika">Statisztika</a>
        <a href="?o=admin&a=termek_kezeles">Termékek kezelése</a>
    </div>

    <div class="main-content">
        <?php
        $adminoldalak = [
            "felhasznalo_kezeles" => "oldalak/admin/felhasznalo_kezeles.php",
            "jegy_kezeles" => "oldalak/admin/jegy_kezeles.php",
            "termek_kezeles" => "oldalak/admin/termek_kezeles.php",
            "kupon_kezeles" => "oldalak/admin/kupon_kezeles.php",
            "statisztika" => "oldalak/admin/statisztika.php",
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