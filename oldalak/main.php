<div class="container text mt-3  p-5 mainsite">
    <section class="m-5 p-4">
        <div class="row mb-5" style="text-align:center;">
            <h1><?= $languageContent['udv'] ?></h1>
            <p><?= $languageContent['hypeSzoveg'] ?></p>
            <div class="mb-3">
                <button onclick='window.top.location.href = "./?o=arak";'
                    class="btn btn-warning"><?= $languageContent['csatlakozz'] ?></button>
            </div>
        </div>
        <div class="row mb-5">
            <h1 class="mb-4"><?= $languageContent['miertNalunk'] ?></h1>
            <div class="col-md-6" style="text-align:center;">
                <i class='fas fa-burn mb-3' style='font-size:36px'></i>
                <h4><?= $languageContent['csoportosOrak'] ?></h4>
                <p><?= $languageContent['proHozzaferes'] ?></p>
            </div>
            <div class="col-md-6" style="text-align:center;">
                <i class="fa-solid fa-heart mb-3" style="font-size:36px"></i>
                <h4><?= $languageContent['edzes'] ?></h4>
                <p><?= $languageContent['tanacsadas'] ?></p>
            </div>
            <i class="fa fa-arrow-down" style="font-size:36px; text-align:center;"></i>
        </div>
    </section>

    <section class="m-5 text-center app-promo">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <h1 class="app-title"><?=$languageContent["liftzoneapp"]?></h1>
                    <p class="app-subtitle"><?=$languageContent["mobilappleiras"]?></p>
                    <a href="./downloads/LiftZone.apk" class="btn btn-success btn-lg mt-3" download>
                        <i class="fa fa-download"></i> <?=$languageContent["appletoltes"]?>
                    </a>
                </div>
                <div class="col-md-6">
                    <img src="./images/Mobile.png" class="img-fluid app-image" alt="LiftZone App Preview">
                </div>
            </div>
        </div>
    </section>


    <!-- Webshop Products Section -->
    <section class="m-5">
        <div class="row mb-5">
            <h1 class="mb-4"><?= $languageContent['products'] ?></h1>
            <?php
            $termekek = sqlcall("SELECT * FROM termekek ORDER BY teDatum DESC LIMIT 4");
            while ($termek = $termekek->fetch_assoc()):
                $mappa = "./images/termekek/" . $termek['teID'] . "/";
                $coverImage = "default.png";
                if (is_dir($mappa)) {
                    $images = glob("$mappa*.{png,jpg,jpeg,gif,webp}", GLOB_BRACE);
                    if (!empty($images)) {
                        $coverImage = $images[0];
                    }
                }
            ?>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card" style="margin: 1rem;">
                        <img src="<?= htmlspecialchars($coverImage); ?>" class="card-img-top"
                            alt="<?= htmlspecialchars($termek['teNev']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($termek['teNev']); ?></h5>
                            <p class="card-text"><strong>Price:</strong> <?= htmlspecialchars($termek['teAr']); ?> Ft</p>
                            <a href="?o=termek&id=<?= $termek['teID']; ?>" class="btn btn-primary">Tovább</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="?o=shop" class="btn btn-primary"><?= $languageContent['toProducts'] ?></a>
    </section>



    <section id="gepek" class="p-2">
        <section class="m-5">
            <div class="row  mb-5">
                <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                    <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['modernGepek'] ?></h1>
                    <p><?= $languageContent['modernGepekSzovege'] ?></p>
                    <button onclick='window.top.location.href = "./?o=arak";'
                        class="btn btn-dark text-white mb-2"><?= $languageContent['ar'] ?> <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>
                </div>
                <div class="col-md-6"></div>
            </div>
        </section>

        <section class="m-5">
            <div class="row mb-5">
                <div class="col-md-6"></div>
                <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                    <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['fitnessCardio'] ?>
                    </h1>
                    <p><?= $languageContent['fitnessCardioSzovege'] ?></p>
                    <button onclick='window.top.location.href = "./?o=arak";'
                        class="btn btn-dark text-white mb-2"><?= $languageContent['info'] ?> <i
                            class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </section>
    </section>
    <!-- News Board Section -->
    <section class="m-5">
        <div class="row mb-5">
            <?php
            $news = sqlcall("SELECT * FROM uzenofal ORDER BY uzenoDatum DESC LIMIT 1");
            if ($news->num_rows > 0):
                $legujjabbhir = $news->fetch_assoc();
                $truncatedText = implode(' ', array_slice(explode(' ', $legujjabbhir['uzenoSzoveg']), 0, 20)) . '...';
            ?>
                <div class="col-md-12">
                    <div class="blokk">
                        <div class="card-body">
                            <h5 class="card-title" id="uzenoCim"><?= htmlspecialchars($legujjabbhir['uzenoCim']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($truncatedText); ?></p>
                            <p class="card-text"><small
                                    class="text-muted"><?= htmlspecialchars($legujjabbhir['uzenoDatum']); ?></small></p>
                            <?php if (!empty($legujjabbhir['uzenoKep'])): ?>
                                <img src="images/uzenofal/<?= htmlspecialchars($legujjabbhir['uzenoKep']); ?>"
                                    class="card-img-top uzenofalKep" alt="News Image"><br>
                            <?php endif; ?>
                            <a href="?o=uzenofal" class="btn btn-primary"><?= $languageContent['readMore'] ?></a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p><?= $languageContent['noNews'] ?></p>
            <?php endif; ?>
        </div>
    </section>



    <section class="sliders">
        <div class="row">
            <h1><?= $languageContent['szponzorok'] ?></h1>
            <div class="logos">
                <div class="logos-slide">
                    <img src="./images/sponsors/sponsor1.webp" />
                    <img src="./images/sponsors/sponsor2.webp" />
                    <img src="./images/sponsors/sponsor3.webp" />
                    <img src="./images/sponsors/sponsor4.webp" />
                    <img src="./images/sponsors/sponsor5.webp" />
                    <img src="./images/sponsors/sponsor6.webp" />
                    <img src="./images/sponsors/sponsor7.webp" />
                    <img src="./images/sponsors/sponsor8.webp" />
                </div>
            </div>
        </div>

        <?php
        $visibility_result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeVisibility = 1");
        if ($visibility_result->num_rows > 0):
        ?>

            <div class="logos">
                <h1><?= $languageContent['partnerek'] ?></h1>

                <div class="row logos-slide edzo m-1">
                    <?php
                    $visibility_result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeVisibility = 1");
                    while ($row = $visibility_result->fetch_assoc()):
                        $szeKepek = json_decode($row['szeKepek'], true);
                    ?>
                        <div class="edzo-item">
                            <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>">
                                <img src="./<?php echo isset($row['szeKepek']) ? $row['szeKepek'] : 'images/default.jpg'; ?>"
                                    alt="Edző képe" />

                            </a>
                            <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>"
                                class="edzo-nev"><?php echo htmlspecialchars($row['szeuFelhasznalonev']); ?><br>
                                <button type="button"
                                    class="btn btn-warning tovabb-gomb"><?= $languageContent['tovabbgomb'] ?></button>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        <?php endif; ?>

    </section>

    <section class="m-5">
        <div class="row mb-5">
            <div class="col-md-6" style="text-align:left;">
                <h1 style="text-align:left;"><?= $languageContent['gyere'] ?></h1>
                <p><?= $languageContent['cimunk'] ?></p>
                <p><a href="mailto:info@liftzone.hu" class="text-warning"><?= $languageContent['email'] ?></a></p>
                <p><?= $languageContent['tel'] ?></p>
                <p><?= $languageContent['nyitva'] ?></p>
            </div>

            <div class="col-md-6" style="text-align: right;">
                <h1 style="text-align:left;"><?= $languageContent['terkep'] ?></h1>
                <div id="map"></div>
            </div>
        </div>
    </section>
    <section>
        <h1><?= $languageContent["irjNekunk"] ?></h1>

        <p><?= $languageContent["lepjKapcsolatba"] ?></p>
        <div class="contact-form mt-4 p-3 rounded"
            style="background-color: var(--transparent-black); max-width: 400px; margin: auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
            <form action="actions/uzenet_kuldes.php" method="post" target="kisablak">
                <div class="form-group">
                    <label for="email" class="text-white"><?= $languageContent["emailLabel"] ?></label>
                    <input type="email" name="email" id="email" class="form-control" style="border-radius: 5px;"
                        required>
                </div>
                <div class="form-group mt-2">
                    <label for="message" class="text-white"><?= $languageContent["uzenetLabel"] ?></label>
                    <textarea name="message" id="message" rows="3" class="form-control"
                        style="border-radius: 5px; resize: none;" required maxlength="300"></textarea>
                </div>
                <button type="submit" class="btn btn-warning mt-3 w-100"
                    style="border-radius: 20px;"><?= $languageContent["kuldes"] ?></button>
            </form>
        </div>


    </section>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([47.419883635087345, 19.057171205846025], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([47.419883635087345, 19.057171205846025]).addTo(map);

        marker.bindPopup("<b>Csepel</b><br>Edzőtermünk helyszíne.").openPopup();
    </script>
</div>