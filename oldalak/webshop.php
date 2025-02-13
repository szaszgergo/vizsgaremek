<div class="container bg-transparentblack webshop">
    <div class="row">
        <?php
        $termekek = sqlcall("SELECT * FROM termekek WHERE teStatus = 1");
        if ($termekek->num_rows > 0):
        while ($termek = $termekek->fetch_assoc()):
            ?>
            <div class="col-md-3">
                <div class="product-card">
                    <?php
                    $mappa = "./images/termekek/" . $termek['teID'] . "/";
                    $coverImage = "default.png";

                    if (is_dir($mappa)) {
                        $images = glob("$mappa*.{png,jpg,jpeg,gif,webp}", GLOB_BRACE);
                        if (!empty($images)) {
                            $coverImage = $images[0];
                        }
                    }
                    ?>
                    <img src="<?php echo htmlspecialchars($coverImage); ?>" class="product-img"
                        alt="<?php echo htmlspecialchars($termek['teNev']); ?>">
                    <div class="product-info">
                        <h5><?php echo htmlspecialchars($termek['teNev']); ?></h5>
                        <p><?php echo htmlspecialchars($termek['teLeiras']); ?></p>
                        <p><strong>Price:</strong> <?php echo htmlspecialchars($termek['teAr']); ?> Ft</p>
                        <div class="row">
                            <a href="?o=termek&id=<?php echo $termek['teID']; ?>" class="btn btn-primary col-md-3">Tovább</a>
                            <div class="col-md-6"></div>
                            <form class="col-md-3" action="actions/kosar_termek_hozzaadas.php" method="POST" target="kisablak">
                                <input type="hidden" name="teID" value="<?php echo $termek['teID']; ?>">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart fa-xl"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php else: ?>
            <h1>Jelenleg nincsenek termékeink!</h1>
            <a class="btn btn-primary" href="../">Vissza a főoldalra!</a>
        <?php endif;?>
    </div>
</div>
