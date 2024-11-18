<?php
if (isset($_GET['id'])):
    $id = intval($_GET['id']);
    $termeklekerdezes = sqlcall("SELECT * FROM termekek WHERE teID = $id");

    if ($termeklekerdezes->num_rows > 0):
        $termek = $termeklekerdezes->fetch_assoc();
    else:
        echo "<p>Product not found.</p>";
        exit;
    endif;

    $kepekMappa = "images/termekek/$id/";
    $kepek = glob("$kepekMappa*.{png,jpg,jpeg,gif}", GLOB_BRACE);
?>
    <div class="container mt-5 bg-transparentblack termek">
        <div class="row align-items-center">
        <div class="col-md-6">
                <?php if (!empty($kepek)): ?>
                <div id="productGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($kepek as $index => $image): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo $image; ?>" class="d-block w-100" alt="Product Image <?php echo $index + 1; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php else: ?>
                    <p>No images available for this product.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <div>
                    <h1><?php echo htmlspecialchars($termek['teNev']); ?></h1>
                    <h3 class="text-warning"><?php echo htmlspecialchars($termek['teAr']); ?> Ft</h3>
                    <p><?php echo nl2br(htmlspecialchars($termek['teLeiras'])); ?></p>
                    <button class="btn btn-primary">Add to Cart</button>
                    <a href="index.php" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
