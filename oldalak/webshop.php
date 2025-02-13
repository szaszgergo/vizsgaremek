<?php
// Get the current view from URL parameter (default to 'products')
$view = isset($_GET['view']) && $_GET['view'] === 'passes' ? 'passes' : 'products';

// Preserve existing query parameters
$queryParams = $_GET;
$queryParams['view'] = 'products';
$productsUrl = '?' . http_build_query($queryParams);

$queryParams['view'] = 'passes';
$passesUrl = '?' . http_build_query($queryParams);

// Fetch webshop products
$termekek = sqlcall("SELECT * FROM termekek WHERE teStatus = 1");

// Fetch passes from the database
$jegyek = sqlcall("SELECT * FROM tipusok");
?>

<div class="container webshop bg-transparentblack">
    <div class="toggle-buttons text-center mb-4">
        <a href="<?php echo htmlspecialchars($productsUrl); ?>" class="btn <?php echo $view === 'products' ? 'btn-primary' : 'btn-secondary'; ?>">Termékek</a>
        <a href="<?php echo htmlspecialchars($passesUrl); ?>" class="btn <?php echo $view === 'passes' ? 'btn-primary' : 'btn-secondary'; ?>">Bérletek</a>
    </div>

    <!-- Webshop Section -->
    <?php if ($view === 'products'): ?>
        <div id="products-section" class="webshop-section">
            <div class="row">
                <?php if ($termekek->num_rows > 0): ?>
                    <?php while ($termek = $termekek->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4">
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
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Passes Section -->
    <?php if ($view === 'passes'): ?>
        <div id="passes-section" class="passes-section">
            <div class="row">
                <?php if ($jegyek->num_rows > 0): ?>
                    <?php while ($jegy = $jegyek->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                            <div class="text-white">
                                <div class="card-body">
                                    <h4 class="card-title text-start"><?php echo htmlspecialchars($jegy['tpNev']); ?></h4>
                                    <p class="card-text text-start"><?php echo htmlspecialchars($jegy['tpAr']); ?> HUF</p>
                                    <input type="hidden" name="tpID" value="<?php echo htmlspecialchars($jegy['tpID']); ?>" readonly>
                                    <form class="col-md-3" action="actions/kosar_jegy_hozzaadas.php" method="POST" target="kisablak">
                                            <input type="hidden" name="tpID" value="<?php echo $jegy['tpID']; ?>">
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart fa-xl"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h1>Jelenleg nincsenek bérleteink!</h1>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
