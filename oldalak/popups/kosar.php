<div class="modal fade" id="kosarpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Kosár</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="" target="kisablak" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col"><strong>Kép</strong></div>
                        <div class="col"><strong>Description</strong></div>
                        <div class="col"><strong>Price</strong></div>
                        <div class="col"><strong></strong></div>
                        <div class="col"><strong></strong></div>

                    </div>
                    <?php
                    require("actions/getkosarcontent.php");
                    $cartContent = getKosarContent();

                    $cartContentIterator = new ArrayIterator($cartContent);
                    while ($cartContentIterator->valid()):
                        $item = $cartContentIterator->current();
                        $type = $item["type"];
                        $details = $item["details"];
                        $teid = $details["teID"];
                        $count = $item["count"];
                        $name = $details["teNev"];
                        $price = number_format($details["teAr"], 0, ',', ' ');
                        $description = $details["teLeiras"];
                        $cartContentIterator->next();
                        ?>
                        <div class="row" id="inputcontainer">
                            <div class="col">
                                <?php
                                $mappa = "./images/termekek/" . $teid . "/";
                                $coverImage = "default.png";

                                if (is_dir($mappa)) {
                                    $images = glob("$mappa*.{png,jpg,jpeg,gif,webp}", GLOB_BRACE);
                                    if (!empty($images)) {
                                        $coverImage = $images[0];
                                    }
                                } ?>
                                <img src="<?= htmlspecialchars($coverImage); ?>"
                                    alt="<?= htmlspecialchars($name); ?>" style="max-width: 100px; max-height: 100px;">
                            </div>
                            <div class="col">
                                <strong><?= htmlspecialchars($name); ?></strong><br>
                            </div>
                            <div class="col">
                                <span><?= $price; ?> Ft</span>
                            </div>
                            <div class="col">
                                <span><?= $count; ?> db</span>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-danger btn-sm">X</button>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Vásárlás</button>
                </div>
            </form>
        </div>
    </div>
</div>