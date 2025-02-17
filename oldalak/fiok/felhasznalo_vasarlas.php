<?php $kosarak = getUserKosarak(); ?> 

<div class="container my-4">
    <h2 class="text-center text-warning mb-4">Korábbi vásárlásaid</h2>

    <?php while ($kosar = $kosarak->fetch_assoc()): 
        $kosartermekek = getKosarContent($kosar["koID"]);

        // Calculate total price
        $totalPrice = 0;
        $hasPasses = false;

        foreach ($kosartermekek as $item) {
            $itemPrice = $item["details"]["teAr"] ?? $item["details"]["tpAr"]; // Get correct price field
            $totalPrice += $itemPrice * $item["count"]; // Multiply price by quantity

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

                <!-- Only show the "Megvásárolt bérletek" card if there are passes -->
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
