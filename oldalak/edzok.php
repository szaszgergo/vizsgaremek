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

    .comment-image {
        object-fit: cover;
        margin-right: 15px;
    }
</style>
<form action="actions/edzo_leiras_mentes.php" target="kisablak" method="post" enctype="multipart/form-data">
    <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
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
                    <h1><input class="leiras_textarea" name="mentes_nev" type="text" value="<?= $row['szeuFelhasznalonev']; ?>" placeholder="Teljes név..." readonly style="background: transparent; color: #fff;"></h1>
                    <h3><i class="fa-solid fa-location-dot" style="font-size:24px;"></i> Csepel</h3>
                    <hr class="text-warning">
                </div>
                <!-- ide -->
                <div class="d-flex bg-transparentblack m-3 p-5">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col">
                                <h3><?= $languageContent["elerhetosegek"] ?></h3>
                                <p><input class="leiras_textarea" name="mentes_email" type="text" value="<?= $row['szeEmail']; ?>" placeholder="Email cím..." readonly style="background: transparent; color: #fff;">&nbsp;<i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i></p>
                                <p><input class="leiras_textarea" name="mentes_telefon" type="text" value="<?= $row['szeTelefon']; ?>" placeholder="Telefonszám..." readonly style="background: transparent; color: #fff;">&nbsp;<i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i></p>
                                <p>
                                    Végzettségek: <br> <textarea class="leiras_textarea" name="mentes_vegzettseg" readonly style="background: transparent; color: #fff; resize: none;"><?= $row['szeVegzetseg']; ?></textarea>
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
                                <h3 class='mt-1'>Kép feltöltése</h3>
                                <?php if(isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
                                <input id="kep_feltoltes" name="mentes_kep" type="file" disabled>
                                <?php else: ?>
                                <input id="kep_feltoltes" name="mentes_kep" type="file">
                                <?php endif; ?>
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
                        <!-- innen -->
                        <p class="motivational-text">
                            <textarea style="background: transparent; color: #fff; resize: none; width: 100%; min-height: 400px;" readonly class="leiras_textarea" name="edzo_leirasa"> <?= $row['szeLeiras']; ?> </textarea>
                        </p>

                        <?php
                        $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
                        $eid = $_GET['eid'];
                        $sql = "SELECT * FROM szemelyi_edzok WHERE szeUID = $uid AND szeID = $eid";
                        $result = sqlcall($sql);
                        $number_of_rows = $result->num_rows;
                        if ($number_of_rows > 0):
                        ?>
                            <div class="btn btn-warning" style="font-size: 1.2rem;" id="edit_leiras">Szerkesztés</div>
                            <button class="btn btn-warning" style="font-size: 1.2rem;">Mentés</button>

                            <a href="?o=edzok&eid=10&visibility=public"><div class="btn btn-success" style="font-size: 1.2rem; float: right; margin-left: 5px; color: #ddd;" id="edit_leiras">Public</div></a>
                            <a href="?o=edzok&eid=10&visibility=private"><div class="btn btn-danger" style="font-size: 1.2rem; float: right; color: #ddd;" id="edit_leiras">Private</div></a>
                        <?php endif; ?>
                        <?php
                        if (isset($_GET['visibility']) && $_GET['visibility'] == 'public') {
                            $sql = "UPDATE szemelyi_edzok SET szeVisibility = 1 WHERE szeID = $eid";
                            sqlcall($sql);
                        } else if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') {
                            $sql = "UPDATE szemelyi_edzok SET szeVisibility = 0 WHERE szeID = $eid";
                            sqlcall($sql);
                        }
                        ?>
</form>
<!-- Csillagos értékelés és forma -->
<?php if(isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
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
<?php endif; ?>

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
        <img id="prof_pic" class="d-block" src="<?php echo $row['szeKepek']; ?>" alt="Profilkép">
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
        <div class="col-md-6 p-3">
            <p><?= $languageContent["jelentkezzItt"] ?></p>

            <?php if(isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
            <button id="booking-button" type="button" class="btn btn-warning" style="font-size:20px;">
                <?= $languageContent["jelentkezes"] ?>
            </button>
            <?php endif; ?>
            <div id="error-message" class="alert alert-danger mt-3 p-1" style="display: none; width:88%;">Nem vagy bejelentkezve!</div>

        </div>
        <div class="col-md-6 p-3">
            <p><?= $languageContent["irjEmail"] ?> <br> <i class="fa fa-envelope m-1" aria-hidden="true" style="font-size: 24px;"></i>
                <?php print "<span class='text-warning'> " . $row["szeEmail"] . " </span>" ?>
            </p>
        </div>
    </div>
    <!-- talan -->
    <script>
        document.getElementById('booking-button').addEventListener('click', function() {
            <?php if (!isset($_SESSION['uid'])): ?>
                document.getElementById('error-message').style.display = 'block';
            <?php else: ?>
                window.top.location.href = '/foglalas&eid=<?php echo $row['szeID']; ?>';
            <?php endif; ?>
        });
    </script>

    <div class="komment">
        <?php if(isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
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
            <?php endif;?>
            <div class="row">
                <div class="col-md-3"> <button id="szerkezdkomment_valtoztatas" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="button"><?php echo $languageContent['edit']; ?></button>
                </div>
                <div class="col-md-3">
                    <button id="szerkezdkomment" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="submit" formaction="actions/komment_update.php" class="btn btn-danger"><?php echo $languageContent['send']; ?></button>
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

                        const editBtn = document.getElementById('edit_leiras')
                        let leiras = document.querySelectorAll('.leiras_textarea')
                        let kep = document.getElementById('kep_feltoltes')

                        editBtn.onclick = function() {
                            leiras.forEach(element => {
                                if (element.hasAttribute('readonly')) {
                                    element.removeAttribute('readonly')
                                    element.style.backgroundColor = "#fff"
                                    element.style.color = "black"
                                } else {
                                    element.setAttribute('readonly', 'true')
                                    element.style.backgroundColor = "transparent"
                                    element.style.color = "#fff"
                                }
                            });
                        }
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
                $result = sqlcall("SELECT uFelhasznalonev, ekKomment, ekDatum, uProfilePic FROM user, edzok_kommentek WHERE ekUserID = uID AND ekSzeID=$eid AND ek_Status=1 ORDER BY ekDatum DESC");

                if ($result->num_rows > 0) {
                    echo "<h2 class='m-3'>Vélemények:</h2>";
                    while ($row = $result->fetch_assoc()) {
                        $adat = [
                            'nev' => $row['uFelhasznalonev'],
                            'komment' => $row['ekKomment'],
                            'datum' => $row['ekDatum'],
                            'profilePic' => !empty($row['uProfilePic']) ? $row['uProfilePic'] : '../images/pic.png'
                        ];

                        echo "
                <div class='komment bg-transparentblack m-3 p-3 w-50'>
                    <span style='display: flex; justify-content: space-between; width: 100%; align-items: center;'>
                        <h4><img alt='Profile Image' class='comment-image' src='profile_pic/{$adat['profilePic']}' style='height: 50px; width: 50px; border-radius: 50%;'/>{$adat['nev']} </h4>
                       
                        <h4 style='text-align: right;'>{$adat['datum']}</h4>
                    </span>
                    <p>{$adat['komment']}</p>
                  
                   
                </div>";
                    }
                } else {
                    echo "Nincs találat.";
                }
        ?>
    </div>
</div>



<?php endwhile; ?>


</div>
</div>