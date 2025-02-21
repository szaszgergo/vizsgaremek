<?php
$start = 0;
$rows_per_page = 4; // Ennyi vásárlást mutatunk egyszerre
$page = 0;
// Összes vásárlás lekérése az adott felhasználótól
$records = sqlcall("SELECT * FROM kosar WHERE koUID = {$_SESSION['uid']} AND koTranzakcioID IS NOT NULL ORDER BY koTranzakcioID DESC");
$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

// Lapozott lekérdezés a vásárlásokhoz
$kosarak = sqlcall("SELECT * FROM kosar WHERE koUID = {$_SESSION['uid']} AND koTranzakcioID IS NOT NULL ORDER BY koID DESC LIMIT $start, $rows_per_page");
?>

<div class="container my-4">
    <h2 class="text-center text-warning mb-4">Korábbi vásárlásaid</h2>

    <?php while ($kosar = $kosarak->fetch_assoc()): 
        $kosartermekek = getKosarContent($kosar["koID"]);

        // Teljes ár kiszámítása
        $totalPrice = 0;
        $hasPasses = false;

        foreach ($kosartermekek as $item) {
            $itemPrice = $item["details"]["teAr"] ?? $item["details"]["tpAr"];
            $totalPrice += $itemPrice * $item["count"];

            if ($item["type"] === "JEGY") {
                $hasPasses = true;
            }
        }
    ?>

    <div class="card mb-4 shadow-lg">
        <div class="card-header bg-dark text-light d-flex justify-content-between">
            <h5 class="mb-0">Vásárlás azonosító: #<?= $kosar["koID"] ?></h5>
            <h5 class="mb-0">Teljes összeg: <?= number_format($totalPrice, 0, ',', '.') ?> Ft</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($kosartermekek as $item): ?>
                    <?php if ($item["type"] === "TERMEK"): ?>
                        <div class="col-md-2 mb-3">
                            <div class="card h-100">
                                <img src="images/termekek/<?= $item["details"]["teID"] ?>/main.png" class="card-img-top" alt="<?= $item["details"]["teNev"] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $item["details"]["teNev"] ?></h5>
                                    <p class="card-text"><strong>Ár:</strong> <?= number_format($item["details"]["teAr"], 0, ',', '.') ?> Ft</p>
                                    <p class="card-text"><strong>Mennyiség:</strong> <?= $item["count"] ?> db</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ($hasPasses): ?>
                    <div class="col-md-2">
                        <div class="card bg-warning text-dark">
                            <div class="card-header"><h5>Megvásárolt bérletek</h5></div>
                            <div class="card-body">
                                <?php foreach ($kosartermekek as $item): ?>
                                    <?php if ($item["type"] === "JEGY"): ?>
                                        <div class="border-bottom pb-2 mb-2">
                                            <h6><?= $item["details"]["tpNev"] ?></h6>
                                            <p><strong>Időtartam:</strong> <?= $item["details"]["tpHossz"] ?> nap</p>
                                            <p><strong>Ár:</strong> <?= number_format($item["details"]["tpAr"], 0, ',', '.') ?> Ft</p>
                                            <p><strong>Mennyiség:</strong> <?= $item["count"] ?> db</p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php endwhile; ?>
</div>

<!-- LAPOZÓ NAVIGÁCIÓ -->
<div class="pagination" style="display: flex; justify-content: center; align-items: center;">
    <a href="?o=felhasznalo_vasarlas&page-nr=1" class="pagination-btn">Első</a>

    <?php if ($page > 0): ?>
        <a href="?o=felhasznalo_vasarlas&page-nr=<?= $page ?>" class="pagination-btn">Előző</a>
    <?php else: ?>
        <a class="pagination-btn disabled">Előző</a>
    <?php endif; ?>

    <div class="page-numbers">
        <?php
        $max_visible_pages = 4;
        $start_page = max(1, $page - 2);
        $end_page = min($pages, $start_page + $max_visible_pages - 1);

        if ($end_page - $start_page + 1 < $max_visible_pages) {
            $start_page = max(1, $end_page - $max_visible_pages + 1);
        }

        for ($counter = $start_page; $counter <= $end_page; $counter++) {
            $activeClass = ($counter == $page + 1) ? 'active' : '';
        ?>
            <a class="pagination-btn <?= $activeClass; ?>" href="?o=felhasznalo_vasarlas&page-nr=<?= $counter; ?>"><?= $counter; ?></a>
        <?php } ?>
    </div>

    <?php if ($page + 1 < $pages): ?>
        <a href="?o=felhasznalo_vasarlas&page-nr=<?= $page + 2; ?>" class="pagination-btn">Következő</a>
    <?php else: ?>
        <a class="pagination-btn disabled">Következő</a>
    <?php endif; ?>

    <a href="?o=felhasznalo_vasarlas&page-nr=<?= $pages; ?>" class="pagination-btn">Utolsó</a>
</div>
