<?php
$start = 0;
$rows_per_page = 4;

$records = sqlcall("SELECT * FROM kosar WHERE koUID = {$_SESSION['uid']} AND koTranzakcioID IS NOT NULL ORDER BY koTranzakcioID DESC");
$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$kosarak = sqlcall("SELECT * FROM kosar WHERE koUID = {$_SESSION['uid']} AND koTranzakcioID IS NOT NULL ORDER BY koID DESC LIMIT $start, $rows_per_page");
?>

<div class="container my-4">
    <h2 class="text-center text-warning mb-4"><?= $languageContent["purchases"] ?></h2>

    <?php while ($kosar = $kosarak->fetch_assoc()): 
        $kosartermekek = getKosarContent($kosar["koID"]);

        $totalPrice = 0;
        $hasPasses = false;
        $validItems = false;

        foreach ($kosartermekek as $item) {
            if ($item["count"] > 0) {
                $validItems = true;
                $itemPrice = $item["details"]["teAr"] ?? $item["details"]["tpAr"];
                $totalPrice += $itemPrice * $item["count"];

                if ($item["type"] === "JEGY") {
                    $hasPasses = true;
                }
            }
        }

        if (!$validItems) {
            continue;
        }
    ?>

    <div class="card mb-4 shadow-lg">
        <div class="card-header bg-dark text-light d-flex justify-content-between">
            <h5 class="mb-0"><?= $languageContent["purchaseID"] ?>: #<?= $kosar["koID"] ?></h5>
            <h5 class="mb-0"><?= $languageContent["totalAmount"] ?>: <?= number_format($totalPrice, 0, ',', '.') ?> Ft</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($kosartermekek as $item): ?>
                    <?php if ($item["count"] > 0 && $item["type"] === "TERMEK"): ?>
                        <div class="col-md-2 mb-3">
                            <div class="card h-100">
                                <img src="images/termekek/<?= $item["details"]["teID"] ?>/main.png" class="card-img-top" alt="<?= $item["details"]["teNev"] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $item["details"]["teNev"] ?></h5>
                                    <p class="card-text"><strong><?= $languageContent["price"] ?>:</strong> <?= number_format($item["details"]["teAr"], 0, ',', '.') ?> Ft</p>
                                    <p class="card-text"><strong><?= $languageContent["amount"] ?>:</strong> <?= $item["count"] ?> x</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ($hasPasses): ?>
                    <div class="col-md-2">
                        <div class="card bg-warning text-dark">
                            <div class="card-header"><h5><?= $languageContent["purchasedPasses"] ?></h5></div>
                            <div class="card-body">
                                <?php foreach ($kosartermekek as $item): ?>
                                    <?php if ($item["count"] > 0 && $item["type"] === "JEGY"): ?>
                                        <div class="border-bottom pb-2 mb-2">
                                            <h6><?= $item["details"]["tpNev"] ?></h6>
                                            <p><strong><?= $languageContent["timeSpan"] ?>:</strong> <?= $item["details"]["tpHossz"] ?> <?= $languageContent["day"] ?></p>
                                            <p><strong><?= $languageContent["price"] ?>:</strong> <?= number_format($item["details"]["tpAr"], 0, ',', '.') ?> Ft</p>
                                            <p><strong><?= $languageContent["amount"] ?>:</strong> <?= $item["count"] ?> x</p>
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
<div class="page-info" style="text-align: center;">
    <?php
    if (!isset($_GET['page-nr'])) {
        $page = 1;
    } else {
        $page = $_GET['page-nr'];
    }
    ?>
    <?= $languageContent["showing"] ?> <b style="font-size: 1.2rem;"><?php echo $page; ?></b> <?= $languageContent["of"] ?> <b style="font-size: 1.2rem;"><?php echo $pages; ?></b> <?= $languageContent["pages"] ?>
</div>

<div class="pagination" style="display: flex; justify-content: center; align-items: center;">
    <a href="?o=felhasznalo_vasarlas&page-nr=1" class="pagination-btn"><?= $languageContent["first"] ?></a>
    <?php if ($page > 1): ?>
        <a href="?o=felhasznalo_vasarlas&page-nr=<?= $page - 1 ?>" class="pagination-btn"><?= $languageContent["previous"] ?></a>
    <?php else: ?>
        <a class="pagination-btn disabled"><?= $languageContent["previous"] ?></a>
    <?php endif; ?>

    <?php for ($counter = 1; $counter <= $pages; $counter++): ?>
        <a class="pagination-btn <?= ($counter == $page) ? 'active' : ''; ?>" href="?o=felhasznalo_vasarlas&page-nr=<?= $counter; ?>"><?= $counter; ?></a>
    <?php endfor; ?>

    <?php if ($page < $pages): ?>
        <a href="?o=felhasznalo_vasarlas&page-nr=<?= $page + 1; ?>" class="pagination-btn"><?= $languageContent["next"] ?></a>
    <?php else: ?>
        <a class="pagination-btn disabled"><?= $languageContent["next"] ?></a>
    <?php endif; ?>
    <a href="?o=felhasznalo_vasarlas&page-nr=<?= $pages; ?>" class="pagination-btn"><?= $languageContent["last"] ?></a>
</div>
