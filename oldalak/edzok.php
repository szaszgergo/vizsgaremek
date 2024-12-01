<style>
    body {
        text-align: justify;
    }

    .row {
        font-size: 20px;
    }

    #prof_pic {
        width: 90%;
        height: 700px;
        border-radius: 20%;

    }

    #gombok {
        border-radius: 100%;
        height: 20px;
        width: 20px;
        list-style-type: none;

    }

    .carousel-control-next-icon {
        transform: translateX(-60px);
    }

    .carousel-indicators li {
        transform: translateX(-38px);
    }

    .container-fluid {
        overflow-x: unset;
        /* ez még nem annyira fasza */
    }

    body {
        overflow-x: hidden;
        margin: 0;
    }

    .komment {
        border: solid #ffcc00 3px;
        border-radius: 5px;
        width: 88%;
    }
</style>
<div class="container-fluid">
    <div class="row edzok">
        <?php
        $result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeID = " . intval($_GET['eid']));
        while ($row = $result->fetch_assoc()):
            $szeKepek = json_decode($row['szeKepek'], true);
            $szeSocialMedia = json_decode($row['szeElerhetoseg'], true);
            $galeriakepek = isset($szeKepek['galeriakepeim']) ? $szeKepek['galeriakepeim'] : [];
            if (isset($szeKepek['profilkep']) && !empty($szeKepek['profilkep'])) {
                array_unshift($galeriakepek, $szeKepek['profilkep']);
            }
        ?>
            <div class="row-md-12 m-4 p-1">
                <h1><?php echo htmlspecialchars($row['szeuFelhasznalonev']); ?></h1>
                <h3><i class="fa-solid fa-location-dot" style="font-size:24px;"></i> Csepel</h3>
                <hr class="text-warning">
            </div>

            <div class="d-flex bg-transparentblack m-3 p-5">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <h3><?= $languageContent["elerhetosegek"] ?></h3>
                            <p><i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeEmail']); ?></p>
                            <p><i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeTelefon']); ?></p>
                            <p>
                                <?php
                                if (isset($_SESSION["lang"]) && $_SESSION["lang"] == "en") {
                                    echo htmlspecialchars($row['szeVegzettsegEN']);
                                } else {
                                    echo htmlspecialchars($row['szeVegzetseg']);
                                }
                                ?>
                            </p>
                        </div>
                        <div class="col mt-3">
                            <?php
                            $eid = $_GET['eid'];
                            $sql_csillagok = "SELECT AVG(Csillag_value) as avgStars FROM csillag WHERE CsSzeID=?";
                            $result_csillagok = sqlcall($sql_csillagok, 'i', [$eid]);

                            $ertekelok = "SELECT COUNT(Csillag_value) FROM csillag WHERE CsSzeID=?";
                            $result_ertekelok = sqlcall($ertekelok, 'i', [$eid]);

                            $csUID = $_SESSION['uid'] ?? 0;
                            $sql_felhasznalok = "SELECT csUID FROM csillag WHERE csUID=? AND CsSzeID=?";
                            $result_felhasznalok = sqlcall($sql_felhasznalok, 'ii', [$csUID, $eid]);

                            if ($result_ertekelok) {
                                $row_ertekelok = $result_ertekelok->fetch_row();
                                echo "<h3 class='mt-1'>" . htmlspecialchars($languageContent["ertekeles"]) . " <span style='opacity:50%; color:white;'>($row_ertekelok[0])</span></h3>";
                            }

                            if ($result_csillagok) {
                                $row_csillagok = $result_csillagok->fetch_assoc();
                                $sql_csillagok_ossz = isset($row_csillagok['avgStars']) ? (int)floor($row_csillagok['avgStars']) : 0;

                                echo "<div class='stars'>";
                                for ($i = 0; $i < $sql_csillagok_ossz; $i++) {
                                    echo "<span readonly class='star' style='color: gold;  pointer-events: none;'>&#9733;</span>";
                                }
                                for ($i = $sql_csillagok_ossz; $i < 5; $i++) {
                                    echo "<span readonly class='star' style='color: gray;  pointer-events: none;'>&#9733;</span>";
                                }

                                if ($result_felhasznalok->num_rows > 0) {
                                    echo "<br><span style='font-size:20px;'>" . htmlspecialchars($languageContent["ertekelt"]) . "</span>";
                                }
                                echo "</div>";
                            } else {
                                echo "<div class='stars'>";
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<span readonly class='star' style='color: gray;  pointer-events: none;'>&#9733;</span>";
                                }
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Társasági ikonok -->
                    <div class="social-icons-container">
                        <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['facebook']) ? $szeSocialMedia['facebook'] : '#'; ?>" target="_blank">
                            <i class="fa-brands  fa-facebook-f"></i>
                        </a>
                        <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['instagram']) ? $szeSocialMedia['instagram'] : '#'; ?>" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['tiktok']) ? $szeSocialMedia['tiktok'] : '#'; ?>" target="_blank">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                    <hr class="text-warning">
                    <p class="motivational-text">
                        <?php
                        if (isset($_SESSION["lang"]) && $_SESSION["lang"] == "en") {
                            echo htmlspecialchars($row['szeLeirasEN']);
                        } else {
                            echo htmlspecialchars($row['szeLeiras']);
                        }
                        ?>
                    </p>
                    <p>
                        <?php
                        if (isset($_SESSION["lang"]) && $_SESSION["lang"] == "en") {
                            echo htmlspecialchars($row['szeLeiras2EN']);
                        } else {
                            echo htmlspecialchars($row['szeLeiras2']);
                        }
                        ?>
                    </p>

                    <!-- Csillagos értékelés és forma -->
                    <div class="rating-container ">
                        <h2><?= $languageContent["ertekeld"] ?></h2>
                        <form id="rating-form" action="actions/star_submit.php" target="kisablak" method="POST">
                            <div class="stars ">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" id="star-value" name="star_value" value="0">
                            <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
                            <button type="submit" class="btn btn-warning " style="font-size:20px; margin-left:20px;"><?= $languageContent["ertekelesBekuldes"] ?></button>
                        </form>
                        <p id="error" style="color:red;"></p>
                    </div>

                    <script>
                        // Csillag értékelési script
                        document.querySelectorAll('.star').forEach(star => {
                            star.addEventListener('click', function() {
                                const starValue = this.getAttribute('data-value');
                                document.getElementById('star-value').value = starValue;
                                document.querySelectorAll('.star').forEach(s => {
                                    s.style.color = (parseInt(s.getAttribute('data-value')) <= starValue) ? 'gold' : 'gray';
                                });
                            });
                        });

                        document.getElementById('rating-form').addEventListener('submit', function(event) {
                            if (document.getElementById('star-value').value === "0") {
                                event.preventDefault();
                                alert("Kérlek válassz egy csillagot!");
                            }
                        });
                    </script>

                </div>
                <div class="col-md-6" style="margin-left: 50px;">
                    <!-- pfp -->
                    <?php if (count($galeriakepek) > 1): ?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php foreach ($galeriakepek as $index => $kep): ?>
                                    <li id="gombok" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                                <?php endforeach; ?>
                            </ol>

                            <div class="carousel-inner">
                                <?php foreach ($galeriakepek as $index => $kep): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <img id="prof_pic" class="d-block" src="<?php echo $kep; ?>" alt="Slide <?php echo $index + 1; ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <img id="prof_pic" class="d-block" src="<?php echo $szeKepek['profilkep']; ?>" alt="Profilkép">
                        <style>
                            #carouselExampleIndicators .carousel-control-prev,
                            #carouselExampleIndicators .carousel-control-next,
                            #carouselExampleIndicators .carousel-indicators li {
                                display: none;
                            }
                        </style>
                    <?php endif; ?>

                    <!-- PFP VÉGE -->
                    <div class="row">
                        <form action="" class="w-100">
                            <div class="row">
                                <div class="col-md-6  p-3">
                                    <p><?= $languageContent["jelentkezzItt"] ?></p>
                                    <button type="submit" class="btn btn-warning" style="font-size:20px; "><?= $languageContent["jelentkezes"] ?></button>
                                </div>
                                <div class="col-md-6  p-3">
                                    <p><?= $languageContent["irjEmail"] ?> <br> <i class="fa fa-envelope m-1" aria-hidden="true" style="font-size: 24px;"></i> <?php print "<span class='text-warning'> " . htmlspecialchars($row["szeEmail"]) . " </span>" ?></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="komment">
                        <h2 style="margin:15px;">Írj értékelést az edzőnkről</h2>
                        <?php
                        $existing_comment = "";

                        if (isset($_SESSION['uid'])) {
                            $faszom = "SELECT ekKomment FROM edzok_kommentek WHERE ekUserID=? AND ekSzeID=?";
                            $result_faszom = sqlcall($faszom, 'ii', [$_SESSION['uid'], $eid]);

                            if ($result_faszom->num_rows > 0) {
                                $row = $result_faszom->fetch_assoc();
                                $existing_comment = trim($row['ekKomment']);
                            }
                        }
                        ?>

                        <form action="actions/komment_ir.php" target="kisablak" method="post">
                            <input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">

                            <textarea style="width: 95%; height: 150px; margin-left:15px; border-radius:5px; resize: none; text-align: left; padding: 0; border: 1px solid #ccc;"
                                placeholder="Üzenet" name="textarea_komment" id="textarea_komment" maxlength="300"
                                <?php if (!empty($existing_comment)) echo 'readonly'; ?>>
    <?php echo htmlspecialchars($existing_comment); ?>
</textarea>


                            <button id="elkuldkomment" type="submit" class="btn btn-warning" style="font-size:20px; margin:15px;"
                                <?php if (!empty($existing_comment)) echo 'style="display:none;"'; ?>>
                                Elküldés
                            </button>

                            <div class="row">
                                <div class="col-md-3"> <button id="szerkezdkomment_valtoztatas" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="button">Szerkesztés</button>
                                </div>
                                <div class="col-md-3">
                                    <button id="szerkezdkomment" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="submit" formaction="actions/komment_update.php" class="btn btn-danger">Elküldés</button>
                                    <script>
                                        document.getElementById('szerkezdkomment_valtoztatas').addEventListener('click', function() {
                                            const textarea = document.getElementById('textarea_komment');

                                            if (textarea.hasAttribute('readonly')) {
                                                textarea.removeAttribute('readonly');

                                            } else {
                                                textarea.setAttribute('readonly', 'true');
                                                textarea.style.backgroundColor = '';
                                                textarea.style.borderColor = '';
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <?php
                            if (isset($_SESSION['uid'])) {
                                $sql_ertekelte = "SELECT ekUserID FROM edzok_kommentek WHERE ekUserID=? AND ekSzeID=?";
                                $result_felhasznalok = sqlcall($sql_ertekelte, 'ii', [$_SESSION['uid'], $eid]);

                                if ($result_felhasznalok->num_rows > 0) {

                                    echo "<script>document.getElementById('szerkezdkomment_valtoztatas'). = 'block';</script>";
                                    echo "<script>document.getElementById('szerkezdkomment').style.display = 'block';</script>";
                                    echo "<script>document.getElementById('szerkezdkomment_valtoztatas').style.display = 'block';</script>";
                                    echo "<script>document.getElementById('elkuldkomment').style.display = 'none';</script>";
                                }
                            }
                            ?>
                        </form>
                    </div>

                    <div id='error-message' class='alert alert-danger mt-3 p-1' style='display: none; width:88%;'></div>
                    <div id="success-message" class="mt-3 p-1" style="display: none; width:88%; background-color:#28a745; color: #fff; border-radius: 5px;">
                    </div>






                </div>


            </div>
            <div class="row">
                <div class="kommentek_kiiratas">
                    <?php 
                    
                      $sql = "SELECT uFelhasznalonev,ekKomment, ekDatum FROM user,edzok_kommentek WHERE ekUserID = uID ORDER BY ekDatum DESC;"; // ez fasza 

                     // $result = sqlcall($sql, 'i', [$eid]);

                    
                    ?>
                    <h2>Vélemények:</h2>
                    <div class="komment bg-transparentblack m-3 p-3 w-100">
                        <span style="display: flex; justify-content: space-between; width: 100%;">
                            <h3>Neve</h3>
                            <h3 style="text-align: right;">2020-10-20</h3>
                        </span>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore a deleniti iste, sunt pariatur praesentium, non numquam molestiae laudantium eius vero cum necessitatibus blanditiis ad beatae eveniet vel. A, iure quibusdam quia soluta sequi rem voluptate porro placeat. Voluptas deleniti autem illum odio maxime repellat soluta doloremque numquam totam id.</p>
                    </div>

                </div>
            </div> 

        <?php endwhile; ?>

    </div>
</div>