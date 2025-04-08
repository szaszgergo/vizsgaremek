<style>
    body {
        text-align: justify;
    }

    .row {
        font-size: 20px;
    }

    #prof_pic {
        width: 80%;
        height: 400pt;
        border-radius: 5%;
        margin: auto;
    }

    @media screen and (max-width: 768px) {
        #prof_pic {
            width: 100%;
            height: 200pt;
            margin: 2rem 0;

        }

        .edzoImgContainer {
            margin-left: 0 !important;

        }

        .submitGomb {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .komment {
            width: 100% !important;
            text-align: center;
            margin: auto !important;
        }
        .row {
            width: 100% !important;
            margin: auto !important;
            padding: 0 !important;
        }
        .container-fluid {
            padding: 0 !important;
        }
        .kisSunyi, .edzoPage, .ertekelesTextarea {
            margin: auto !important;
        }
        .week-controls button {
            padding: 5px !important;
            margin: 0 !important;
        }
        .week-controls {
            margin-bottom: 10px !important;
        }

    }

    .ertekelesTextarea {
        background-color: #eee;
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
        margin: auto;
        width: 80%;
    }

    .comment-image {
        object-fit: cover;
        margin-right: 15px;
    }


    th,
    tr,
    td {
        border: solid 2px #ffcc00;
        margin: 10px;
        padding: 10px;
        width: 150px;
        text-align: center;

        cursor: pointer;
    }

    td,
    th {
        border: solid 2px black;
    }

    #tablazat th,
    #tablazat td:first-child {
        border-color: #ffcc00;
    }

    .fotablazat {
        width: 100% !important;
        display: flex;
        justify-content: center;
    }

    @media screen and (max-width: 768px) {
        .fotablazat th, td, tr {
        padding: 0 !important;
        margin: 0 !important;
        font-size: 0.7rem;
    }
    }

    .checkbox-cell {
        background-color: darkgrey;

    }

    .checkbox-cell.checked {
        background-color: lightgreen !important;
    }

    .checkbox-cell.loaded {
        background-color: red !important;
        pointer-events: none;
        /* Betöltött cellák nem szerkeszthetők */
    }

    .checkbox-cell.loadededzo {
        background-color: lightgreen !important;
    }

    input[type="checkbox"] {
        display: none;
    }

    input,
    textarea {
        border: none !important;

    }


    .week-controls {
        text-align: center;
        margin-top: 20px;
    }

    .week-controls button {
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        background-color: #ffcc00;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .week-controls button:hover {
        background-color: #e6b800;
    }

    .week-title {
        font-size: 18px;
        font-weight: bold;
        margin: 0px;
    }

    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    /* A popup doboz */
    .popup-content {
        width: 90%;
        max-width: 500px;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
        font-size: 1.2rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        background-color: white;
        position: relative;
        transform: translate(0%, 20%);
    }

    /* Popup gombok */
    .popup-buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }

    .popup-buttons button {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        border-radius: 5px;

    }

    .popup-buttons .save {
        background-color: green;
        color: white;
    }

    .popup-buttons .cancel {
        background-color: red;
        color: white;
    }
</style>

<?php
require_once 'dialog.php';
?>
<script src="js/success_error.js" defer></script>
<div class="edzooldalstyle">
    <form action="actions/edzo_leiras_mentes.php" target="kisablak" method="post" enctype="multipart/form-data">
        <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
        <div class="container-fluid">
            <div class="row edzok">
                <?php
                $result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeID = " . intval($_GET['eid']));
                while ($row = $result->fetch_assoc()):
                    $szeEmail = isset($row['szeEmail']) ? $row['szeEmail'] : "";
                    $szeKepek = json_decode($row['szeKepek'], true);
                    $szeSocialMedia = json_decode($row['szeElerhetoseg'], true);
                    $galeriakepek = isset($szeKepek['galeriakepeim']) ? $szeKepek['galeriakepeim'] : [];
                    if (isset($szeKepek['profilkep']) && !empty($szeKepek['profilkep'])) {
                        array_unshift($galeriakepek, $szeKepek['profilkep']);
                    }
                ?>
                    <?php
                    $eid = intval($_GET['eid']);
                    $check_status = sqlcall("SELECT szeVisibility FROM szemelyi_edzok WHERE szeID = $eid");
                    ?>
                    <div class="row-md-12 m-4 p-1 kisSunyi">
                        <h1>
                            <input class="leiras_textarea" name="mentes_nev" type="text" value="<?= $row['szeuFelhasznalonev']; ?>" readonly placeholder="Teljes név..." style="color: #ffc107; background: transparent;">
                            <p style="color: #ffc107; margin: 0 !important;"><?= $languageContent["profilStatus"] ?>:
                            <?php
                            if ($check_status->fetch_assoc()["szeVisibility"] == 1) {
                                echo $languageContent["public"];
                            } else {
                                echo $languageContent["private"];
                            }
                            ?>
                            </p>
                        </h1>
                        <h3><i class="fa-solid fa-location-dot" style="font-size:24px;"></i> Csepel</h3>
                        <hr class="text-warning">
                    </div>
                    <!-- ide -->
                    <div class="d-flex bg-transparentblack m-3 p-5 edzoPage">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <h3><?= $languageContent["elerhetosegek"] ?></h3>
                                    <p><input class="leiras_textarea" name="mentes_email" type="text" value="<?= $row['szeEmail']; ?>" placeholder="Email cím..." readonly style="background: transparent; color: #fff;">&nbsp;<i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i></p>
                                    <p><input class="leiras_textarea" name="mentes_telefon" type="text" value="<?= $row['szeTelefon']; ?>" placeholder="Telefonszám..." readonly style="background: transparent; color: #fff;">&nbsp;<i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i></p>
                                    <p>
                                        <span class="mt-1"><?= $languageContent["vegzettseg"] ?>:</span> <br> <textarea class="leiras_textarea" name="mentes_vegzettseg" readonly style="background: transparent; color: #fff; resize: none;"><?= $row['szeVegzetseg']; ?></textarea>
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
                                    <?php if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] == "edzo"): ?>
                                        <h3 class='mt-1'><?= $languageContent["uploadPic"] ?></h3>
                                        <input id="kep_feltoltes" name="mentes_kep" type="file" style="max-width: 100%;">
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
                                <textarea style="background: #fff; color: #000; resize: none; width: 100%; min-height: 400px;" readonly class="leiras_textarea" name="edzo_leirasa"> <?= $row['szeLeiras']; ?> </textarea>
                            </p>

                            <?php
                            if (isset($_SESSION['uid'])):
                                $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
                                $eid = $_GET['eid'];
                                $sql = "SELECT * FROM szemelyi_edzok WHERE szeUID = $uid AND szeID = $eid";
                                $result = sqlcall($sql);
                                $number_of_rows = $result->num_rows;
                                if ($number_of_rows > 0):
                            ?>
                                    <div class="btn btn-warning" style="font-size: 1.2rem;" id="edit_leiras">Szerkesztés</div>
                                    <button class="btn btn-warning" style="font-size: 1.2rem;">Mentés</button>

                                    <a href="?o=edzok&eid=<?= $eid ?>&visibility=public">
                                        <div class="btn btn-success" style="font-size: 1.2rem; float: right; margin-left: 5px; color: #ddd;" id="edit_leiras">Public</div>
                                    </a>
                                    <a href="?o=edzok&eid=<?= $eid ?>&visibility=private">
                                        <div class="btn btn-danger" style="font-size: 1.2rem; float: right; color: #ddd;" id="edit_leiras">Private</div>
                                    </a>
                                <?php endif; ?>
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

    <div class="row">

        <div class="p-3" style="text-align: center;">
            <!-- Csillagos értékelés és forma -->
            <?php if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
                <div class="rating-container" style="margin: auto !important;">
                    <h2><?= $languageContent["ertekeld"] ?></h2>
                    <form id="rating-form" action="actions/edzo_ertekeles.php" target="kisablak" method="POST">
                        <div class="stars ">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" id="star-value" name="star_value" value="0">
                        <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
                        <button type="submit" class="btn btn-warning submitGomb"><?= $languageContent["ertekelesBekuldes"] ?></button>
                    </form>
                    <p id="error" style="color:red;"></p>
                </div>
            <?php endif; ?>
        </div>
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
<div class="col-md-6 edzoImgContainer" style="margin-left: 50px;">
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

    <div class="komment" style="background-color: #fff; color: #000;">
        <?php if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
            <h2 style="margin:15px;"><?= $languageContent["TrainerReview"] ?></h2>
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

                <textarea style="width: 100%; height: 150px; border-radius:5px; resize: none; text-align: left; padding: 0; border: 1px solid #ccc;"
                    placeholder="Üzenet" name="textarea_komment" id="textarea_komment" maxlength="300" class="ertekelesTextarea"
                    <?php if (!empty($existing_comment)) echo 'readonly'; ?>>
                            <?php echo htmlspecialchars($existing_comment); ?>
                        </textarea>


                <button id="elkuldkomment" type="submit" class="btn btn-warning" style="font-size:20px; margin:15px;"
                    <?php if (!empty($existing_comment)) echo 'style="display:none;"'; ?>>
                    <?= $languageContent["kuldes"] ?>
                </button>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-3"> <button id="szerkezdkomment_valtoztatas" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="button"><?php echo $languageContent['edit']; ?></button>
                </div>
                <div class="col-md-3">
                    <button id="szerkezdkomment" class="btn btn-warning" style="font-size:20px; margin:15px; display:none;" type="submit" formaction="actions/komment_valtoztatas.php" class="btn btn-danger"><?php echo $languageContent['send']; ?></button>
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

    <div style="width: 80%; margin: auto; margin-top: 2rem;">
        <p><?= $languageContent["jelentkezzItt"] ?></p>
        <p><?= $languageContent["irjEmail"] ?> <br> <i class="fa fa-envelope m-1" aria-hidden="true" style="font-size: 24px;"></i>
            <?php print "<span class='text-warning'> " . $szeEmail . " </span>" ?>
        </p>
    </div>

    <div style="width: 80%; margin: auto;">
        <?php if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] != "edzo"): ?>
            <h1>Időpont foglalás:</h1>
            <button id="booking-button" type="button" class="btn btn-warning" style="font-size:20px;">
                <?= $languageContent["jelentkezes"] ?>
            </button>
            <script>
                document.getElementById('booking-button').addEventListener('click', function() {
                    <?php if (!isset($_SESSION['uid'])): ?>
                        document.getElementById('error-message').style.display = 'block';
                    <?php else: ?>
                        window.top.location.href = '/foglalas/?eid=<?php echo $row['szeID']; ?>';
                    <?php endif; ?>
                });
            </script>
            <div id="error-message" class="alert alert-danger mt-3 p-1" style="display: none; width:88%;">Nem vagy bejelentkezve!</div>
        <?php endif; ?>
    </div>

</div>

</div>
<div class="row" style="margin: auto;">
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
<?php
if (isset($_SESSION['uid'])):
    $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
    $eid = $_GET['eid'];
    $sql = "SELECT * FROM szemelyi_edzok WHERE szeUID = $uid AND szeID = $eid";
    $result = sqlcall($sql);
    $number_of_rows = $result->num_rows;
    if ($number_of_rows > 0): ?>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class=" bg-transparentblack">
                        <h2>Időpont megadás</h2>
                        <h5>GMT+01:00</h5>
                        <div class="week-controls">
                            <button style="margin-left:40px;" id="prevWeek">Előző hét</button>
                            <span id="currentWeek" class="week-title"></span>
                            <button id="nextWeek">Következő hét</button>
                            <form action="./actions/edzo_beosztas.php" target="kisablak" method="POST">
                                <div id="checkboxes-container"></div> <!-- Ide kerülnek a checkboxok -->
                                <input type="hidden" name="eid" value="<?php print_r($_GET['eid']) ?>">
                                <button id="idomentes">Mentés</button>

                            </form>
                        </div>
                        <div class="fotablazat">
                            <table id="tablazat">
                                <tr>
                                    <th>Idő</th>
                                    <th>Hétfő</th>
                                    <th>Kedd</th>
                                    <th>Szerda</th>
                                    <th>Csütörtök</th>
                                    <th>Péntek</th>
                                    <th>Szombat</th>
                                    <th>Vasárnap</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
            }
            const Adatok = [];
            let startHour = 6;
            let endHour = 23;

            // Hozzáadjuk az aktuális évet
            const currentYear = new Date().getFullYear();

            for (let hour = startHour; hour < endHour; hour++) {
                // A számok előtt 0 hozzáadása, ha kisebbek mint 10
                const hourString = hour < 10 ? `0${hour}` : `${hour}`;
                const startTime = `${hourString}:00:00`;
                const endTime = `${hour + 1 < 10 ? '0' + (hour + 1) : hour + 1}:00:00`;
                const timeRange = `${startTime}`;

                Adatok.push({
                    ido: timeRange,
                    hetfo: "",
                    kedd: "",
                    szerda: "",
                    csutortok: "",
                    pentek: "",
                    szombat: "",
                    vasarnap: ""
                });
            }


            let currentWeekStart = getMonday(new Date());

            window.onload = () => {
                renderTable(Adatok, currentWeekStart);
                updateWeekDisplay();
                loadCheckboxes(); // Betölteni az elmentett állapotokat
            };

            document.getElementById('prevWeek').onclick = () => {
                currentWeekStart.setDate(currentWeekStart.getDate() - 7);
                renderTable(Adatok, currentWeekStart);
                updateWeekDisplay();
                loadCheckboxes(); // Betöltés hétváltáskor
            };

            document.getElementById('nextWeek').onclick = () => {
                currentWeekStart.setDate(currentWeekStart.getDate() + 7);
                renderTable(Adatok, currentWeekStart);
                updateWeekDisplay();
                loadCheckboxes(); // Betöltés hétváltáskor
            };

            function getMonday(date) {
                const day = date.getDay();
                const diff = date.getDate() - day + (day === 0 ? -6 : 1); // Monday is the first day
                return new Date(date.setDate(diff));
            }

            function updateWeekDisplay() {
                const start = new Date(currentWeekStart);
                const end = new Date(start);
                end.setDate(start.getDate() + 6);

                const options = {
                    month: '2-digit',
                    day: '2-digit'
                };

                document.getElementById('currentWeek').textContent =
                    `${start.toLocaleDateString('hu-HU', options)} - ${end.toLocaleDateString('hu-HU', options)}`;

                const weekdays = ['hetfo', 'kedd', 'szerda', 'csutortok', 'pentek', 'szombat', 'vasarnap'];
                weekdays.forEach((day, i) => {
                    const date = new Date(currentWeekStart);
                    date.setDate(currentWeekStart.getDate() + i);
                    const dayCell = document.querySelector(`th:nth-child(${i + 2})`);
                    dayCell.textContent = `${day.charAt(0).toUpperCase() + day.slice(1)}\n${date.toLocaleDateString('hu-HU', options)}`;
                });
            }

            function renderTable(data, weekStart) {
                const table = document.getElementById("tablazat");
                table.querySelectorAll("tr:not(:first-child)").forEach(row => row.remove());

                data.forEach((row, rowIndex) => {
                    let tr = document.createElement('tr');

                    for (const key in row) {
                        if (key === "ido") {
                            addTD(tr, row[key]);
                        } else {
                            addInteractiveCell(tr, key, rowIndex, weekStart);
                        }
                    }

                    table.appendChild(tr);
                });
            }

            function addTD(parent, szoveg) {
                let td = document.createElement("td");
                td.textContent = szoveg;
                parent.appendChild(td);
            }

            function addInteractiveCell(parent, day, rowIndex, weekStart) {
                let td = document.createElement("td");
                td.classList.add("checkbox-cell"); // Alapértelmezett lightgray szín

                let checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.classList.add("checkbox");

                // Dátum és időpont generálása
                const dayDate = new Date(weekStart);
                dayDate.setDate(weekStart.getDate() + ["hetfo", "kedd", "szerda", "csutortok", "pentek", "szombat", "vasarnap"].indexOf(day));
                const dateStr = `${currentYear}-${(dayDate.getMonth() + 1).toString().padStart(2, '0')}-${dayDate.getDate().toString().padStart(2, '0')}`;
                const timeRange = Adatok[rowIndex].ido;
                checkbox.value = `${dateStr} ${timeRange}`; // Checkbox érték beállítása
                td.addEventListener("click", function() {
                    showPopup(td, td);
                });

                td.addEventListener("click", function() {
                    if (!td.classList.contains("loaded")) { // Csak ha nem betöltött cella
                        checkbox.checked = !checkbox.checked;
                        td.classList.toggle("checked", checkbox.checked);
                    }
                });

                td.appendChild(checkbox);
                parent.appendChild(td);
            }




            function closePopup() {
                const popup = document.getElementById("customPopup");
                if (popup) popup.remove();
            }

            function showPopup(cell) {
                if (document.getElementById("customPopup")) return;

                const overlay = document.createElement("div");
                overlay.classList.add("popup-overlay");
                overlay.id = "customPopup";

                const popupContent = document.createElement("div");
                popupContent.classList.add("popup-content");

                if (cell.style.backgroundColor === "red") {
                    const timerange = cell.children[0].value;

                    // AJAX kérés az adatok lekérésére
                    fetch("./actions/get_user_data.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `timerange=${encodeURIComponent(timerange)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                popupContent.innerHTML = `
                
                        <h3>Időpont: ${timerange}</h3>
                        <p><strong>Felhasználó neve:</strong> ${data.username}</p>
                        <p><strong>E-mail:</strong> ${data.email}</p>
                        <p><strong>Telefon:</strong> ${data.phone}</p>
                     
    
                        <div class="popup-buttons">
                            <form action="./actions/edzo_beosztas_lemodasa.php" target="kisablak" method="POST">
                                <input type="hidden" name="ebEID" value="<?php print_r($_GET['eid']) ?>">
                                <input type="hidden" name="ebUID" id="ebUID" value="${data.ebUID}">
                                <input type="hidden" name="idopont" id="idopont" value="${cell.children[0].value}">
                            <button type="button" class="close">Mégse</button>
                            <button type="submit" class="close">Lemondás</button>
                            </form>
                        </div>
                    `;
                            } else {

                            }

                            overlay.appendChild(popupContent);
                            document.body.appendChild(overlay);

                            document.querySelector(".close").addEventListener("click", closePopup);
                        })
                        .catch(error => {
                            console.error("Hiba történt:", error);
                        });

                } else {
                    popupContent.innerHTML = `
                            <form action="./actions/edzo_beosztas.php" target="kisablak" method="POST">
                                <input type="hidden" name="checkboxval" id="checkboxval" value="${cell.children[0].value}">
                                <input type="hidden" name="eid" value="<?php print_r($_GET['eid']) ?>">
                                <p>Szeretnéd menteni ezt az időpontot?</p>
                                     
                                <div class="popup-buttons">
                                    <button type="submit" class="save">Mentés</button>
                                    <button type="button" class="cancel">Mégse</button>
                                </div>
                            </form>
            `;
                    overlay.appendChild(popupContent);
                    document.body.appendChild(overlay);

                    popupContent.querySelector(".cancel").addEventListener("click", closePopup);
                }
            }

            function closePopup() {
                const popup = document.getElementById("customPopup");
                if (popup) popup.remove();
            }



            function saveCheckboxes() {
                const checkboxes = document.querySelectorAll('.checkbox');

                // Hozzáadjuk a hétkulcsot a formhoz

                // Hozzáadjuk a checkboxok értékét rejtett input mezőként a formhoz
                const container = document.getElementById('checkboxes-container');
                container.innerHTML = ''; // Előző adatokat töröljük

                checkboxes.forEach((checkbox, index) => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `checkbox-${index}`;
                    hiddenInput.value = checkbox.checked ? checkbox.value : 0;
                    container.appendChild(hiddenInput);
                });
            }

            function getWeekKey(weekStartDate) {
                return weekStartDate.toISOString().split('T')[0]; // A hét kezdő dátumát ISO formátumban visszaadja
                //  console.log("currentWeekStart", currentWeekStart);
                // console.log("currentWeekStart getweekday", getWeekKey(currentWeekStart));
            }

            function loadCheckboxes() {
                const urlParams = new URLSearchParams(window.location.search);
                const eid = urlParams.get('eid');

                fetch(`actions/get_edzo_beosztas.php?eid=${eid}`)
                    .then(response => response.json())
                    .then(data => {
                        //   console.dir("data", data); // A teljes JSON tartalom megjelenítése a konzolon

                        // Az adatokat objektumokká alakítjuk, hogy könnyebb legyen dolgozni velük
                        const parsedData = data.map(item => {
                            const parts = item.split(' '); // Split string by space
                            return {
                                date: parts[0], // Dátum
                                time: parts[1], // Idő
                                status: parseInt(parts[2]) // Státusz
                            };
                        });

                        //    console.dir("parsedData", parsedData); // A feldolgozott adatok kiírása a konzolra

                        const checkboxes = document.querySelectorAll('.checkbox');
                        checkboxes.forEach(checkbox => {
                            const item = parsedData.find(parsedItem => {
                                // Ellenőrizzük, hogy az adott időpont azonos-e a checkbox értékével
                                return `${parsedItem.date} ${parsedItem.time}` === checkbox.value;
                            });

                            if (item) {
                                //       console.log(`Dátum: ${item.date}, Idő: ${item.time}, Státusz: ${item.status}`); // Debugging log

                                const status = item.status;
                                const parentCell = checkbox.parentElement;

                                // Háttérszín beállítása az állapot alapján
                                if (status === 0) {
                                    parentCell.style.backgroundColor = 'lightgreen'; // Zöld, ha status 0
                                    parentCell.style.pointerEvents = 'none';
                                } else if (status === 1) {
                                    parentCell.setAttribute('style', 'background-color: red !important;');
                                    // Piros, ha status 1
                                    //parentCell.style.pointerEvents = 'none';
                                }

                                // Checkbox bejelölése, ha nincs bejelölve
                                if (!checkbox.checked) {
                                    checkbox.checked = true;
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Hiba történt az edző beosztás betöltésekor:', error));
            }
        </script>
    <?php endif; ?>
<?php endif; ?>
</div>
</div>
</div>