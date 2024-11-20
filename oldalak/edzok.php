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
</style>
<div class="row edzok">
    <?php
    $result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeID = " . intval($_GET['eid']));
    while ($row = $result->fetch_assoc()):
        $szeKepek = json_decode($row['szeKepek'], true);
        $szeSocialMedia = json_decode($row['szeElerhetoseg'], true);
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
                        <h3>Elérhetőségek:</h3>
                        <p><i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeEmail']); ?></p>
                        <p><i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeTelefon']); ?></p>
                        <p><?php echo htmlspecialchars($row['szeVegzetseg']); ?></p>
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
                            echo "<h3 class='mt-1'>Értékelés: <span style='opacity:50%; color:white;'>($row_ertekelok[0])</span></h3>";
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
                                echo "<br><span style='font-size:20px;'>Ez a felhasznaló már értékelt.</span>";
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

                <p class="motivational-text"><?php echo htmlspecialchars($row['szeLeiras']); ?></p>
                <p><?php echo htmlspecialchars($row['szeLeiras2']); ?></p>

                <!-- Csillagos értékelés és forma -->
                <div class="rating-container ">
                    <h2>Értékeld az edzőt:</h2>
                    <form id="rating-form" action="actions/star_submit.php" target="kisablak" method="POST">
                        <div class="stars ">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" data-value="<?php echo $i; ?>">&#9733;</span>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" id="star-value" name="star_value" value="0">
                        <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
                        <button type="submit" class="btn btn-warning " style="font-size:20px; margin-left:20px;">Értékelés beküldése</button>
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
    <img id="prof_pic" src="<?php echo isset($szeKepek['profilkep']) ? $szeKepek['profilkep'] : 'images/edzo.webp'; ?>" alt="Profilkép">
    <div class="row">
        <form action="" class="w-100">
            <div class="row">
                <div class="col-md-6  p-3">
                    <p>Ha felkeltettem az érdeklődésedet és szeretnéd a segítségemet igénybe venni, jelentkezz itt.</p>
                    <button type="submit" class="btn btn-warning" style="font-size:20px; ">Jelentkezés</button>
                </div>
                <div class="col-md-6  p-3">
                    <p>vagy írj email-t nekem itt. <br> <i class="fa fa-envelope m-1" aria-hidden="true" style="font-size: 24px;"></i> <?php print"<span class='text-warning'> ".htmlspecialchars($row["szeEmail"])." </span>" ?></p>
                </div>
            </div>
        </form>
    </div>
</div>



        </div>
    <?php endwhile; ?>
</div>