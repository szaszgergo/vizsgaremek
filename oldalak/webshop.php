<div class="container bg-transparentblack">
    <div class="row">
        <?php
        $termekek = sqlcall("SELECT * FROM termekek");
        while ($termek = $termekek->fetch_assoc()):
            ?>
            <div class="col-md-2">
                <div class="card" style="margin: 1rem;">
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
                    <img src="<?php echo htmlspecialchars($coverImage); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($termek['teNev']); ?>">
                    <div class="card-body text-white bg-dark">
                        <h5 class="card-title"><?php echo htmlspecialchars($termek['teNev']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($termek['teLeiras']); ?></p>
                        <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($termek['teAr']); ?> Ft</p>
                        <a href="?o=termek&id=<?php echo $termek['teID']; ?>" class="btn btn-primary">Tovább</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>