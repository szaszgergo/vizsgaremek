<div class="modal fade" id="kosarpopup" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Kosár</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php $osszar = 0; ?>

            <div class="modal-body">
                <?php if (isset($_SESSION['uid'])): ?>
                    <?php if (count($cartContent) > 0): ?>
                        <div class="row mb-2">
                            <div class="col"><strong>Név</strong></div>
                            <div class="col"><strong>Darabszám</strong></div>
                            <div class="col"><strong>Ár</strong></div>
                            <div class="col"><strong></strong></div>
                        </div>

                        <?php foreach ($cartContent as $item): ?>
                            <?php
                            $type = $item["type"];
                            $details = $item["details"];
                            $count = $item["count"];
                            
                            if ($type === "JEGY") {
                                // JEGY (Pass) Handling
                                $name = $details["tpNev"];
                                $price = $details["tpAr"];
                                $id = $details["tpID"];
                            } else {
                                // TERMÉK (Product) Handling
                                $name = $details["teNev"];
                                $price = $details["teAr"];
                                $id = $details["teID"];
                                $mappa = "./images/termekek/" . $id . "/";
                                $coverImage = "default.png";

                                if (is_dir($mappa)) {
                                    $images = glob("$mappa*.{png,jpg,jpeg,gif,webp}", GLOB_BRACE);
                                    if (!empty($images)) {
                                        $coverImage = $images[0];
                                    }
                                }
                            }

                            $osszar += ($price * $count);
                            ?>

                            <div class="row" id="inputcontainer">
                                <?php if ($type !== "JEGY"): // Only show image for products ?>
                                    <div class="col">
                                        <img src="<?= htmlspecialchars($coverImage); ?>" alt="<?= htmlspecialchars($name); ?>" style="width: 60pt; height: 60pt; object-fit: strech;">
                                    </div>
                                <?php endif; ?>

                                <div class="col">
                                    <strong><?= htmlspecialchars($name); ?></strong><br>
                                </div>
                                <div class="col">
                                    <span><?= $count; ?>x</span>
                                </div>
                                <div class="col">
                                    <span><?= number_format($price * $count, 0, ',', ' ') ?> Ft</span>
                                </div>
                                <div class="col text-right">
                                    <form action="actions/kosar_termek_torles.php" target="kisablak" method="POST">
                                        <input name="id" value="<?php echo htmlspecialchars($id); ?>" type="hidden">
                                        <button type="submit" class="btn btn-danger btn-sm">-</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <h1 class="text">Jelenleg üres a kosarad</h1>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <h1 class="text">Kérjük, jelentkezzen be a vásárláshoz.</h1>
            <?php endif; ?>

            <div class="modal-footer">
                <p class="text-right"><?= number_format($osszar, 0, ',', ' ') ?> Ft</p>
                <form action="actions/vasarlas.php" method="POST" target="kisablak">
                <button type="submit" class="btn btn-primary">Vásárlás</button>
                </form>
            </div>
        </div>
    </div>
</div>
