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

        <div class="col bg-dark m-3 p-5">
            <div class="row">
                <div class="col">
                    <h3>Elérhetőségek:</h3>
                    <p><i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeEmail']); ?></p>
                    <p><i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeTelefon']); ?></p>
                    <?php echo htmlspecialchars($row['szeVegzetseg']); ?></p>
                </div>
                <div class="col mt-3">
                    <?php
                    $eid = $_GET['eid'];
                    $sql_csillagok = "SELECT AVG(Csillag_value) as avgStars FROM csillag WHERE CsSzeID=?"; //$sql
                    $params_csillagok = ['i', $eid];
                    $result_csillagok = sqlcall($sql_csillagok, 'i', [$eid]);
                    $ertekelok = "SELECT COUNT(Csillag_value) FROM csillag WHERE CsSzeID=?";
                    $params_ertekelok = ['i', $eid];
                    $result_ertekelok = sqlcall($ertekelok, 'i', [$eid]);

                    if(isset($_SESSION['uid'])){
                        $csUID =$_SESSION['uid'];
                    }
                    else{
                        $csUID =0;

                    }
                    $sql_felhasznalok = "SELECT csUID FROM csillag WHERE csUID=? AND CsSzeID=?"; 
                    $params_felhasznalok = ['ii', $csUID,$eid];
                    $result_felhasznalok = sqlcall($sql_felhasznalok, 'ii', [$csUID,$eid]);
                    
                    
                   
                    



                    if ($result_ertekelok) {
                        $row_ertekelok = $result_ertekelok->fetch_row();
                        print" <h3 class='mt-1'>Értékelés: <span style='opacity:50%; color:white;'>($row_ertekelok[0])</span></h3>";
                    } else {
                        echo "Hiba történt a lekérdezés során.";
                    }


                    if ($result_csillagok) {
                        $row_csillagok = $result_csillagok->fetch_assoc();
                        if (isset($row_csillagok['avgStars'])) {
                            $sql_csillagok_ossz = (float)$row_csillagok['avgStars']; //ez az elso sql2
                            $sql_csillagok_ossz = floor($sql_csillagok_ossz);
                            $sql_csillagok_ossz = (int)$sql_csillagok_ossz;

                            echo "<div class='stars'>";

                            for ($i = 0; $i < $sql_csillagok_ossz; $i++) {
                                echo "<span readonly class='star' style='color: gold;   pointer-events: none;'>&#9733;</span>";
                            }


                            for ($i = $sql_csillagok_ossz; $i < 5; $i++) {
                                echo "<span readonly class='star' style='color: gray;   pointer-events: none;'>&#9733;</span>";
                            
                            }
                           
                            if ($result_felhasznalok->num_rows > 0) {
                    
                                $row_marertekelt = $result_felhasznalok->fetch_assoc();
                                echo " <br><span style='font-size:20px;'>Ez a felhasznaló már értékelt.</span>";
                            } 

                            echo "</div>";
                        } else {

                            echo "<div class='stars'>";
                            for ($i = 0; $i < 5; $i++) {
                                echo "<span readonly class='star' style='color: gray;   pointer-events: none;'>&#9733;</span>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "Hiba történt az adatbázis lekérdezés során.";
                    }

                    ?>
                </div>
            </div>

        <div class="col bg-transparentblack m-3 p-5">
            <h3>Elérhetőségek:</h3>
            <p><i class="fa fa-envelope" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeEmail']); ?></p>
            <p><i class="fa fa-phone p-1" aria-hidden="true" style="font-size: 24px; margin-right:10px;"></i><?php echo htmlspecialchars($row['szeTelefon']); ?></p>
            <p><?php echo htmlspecialchars($row['szeVegzetseg']); ?></p>
            <div class="social-icons-container">
                <div class="socialicon">
                    <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['facebook']) ? $szeSocialMedia['facebook'] : '#'; ?>" target="_blank">
                        <i class="fa-brands fa-facebook-f" id="socialicon"></i>
                    </a>
                </div>
                <div class="socialicon">
                    <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['instagram']) ? $szeSocialMedia['instagram'] : '#'; ?>" target="_blank">
                        <i class="fa-brands fa-instagram" id="socialicon"></i>
                    </a>
                </div>
                <div class="socialicon">
                    <a class="m-1 p-2" href="<?php echo isset($szeSocialMedia['tiktok']) ? $szeSocialMedia['tiktok'] : '#'; ?>" target="_blank">
                        <i class="fa-brands fa-tiktok" id="socialicon"></i>
                    </a>
                </div>
            </div>

            <hr class="text-warning">

            <p class="motivational-text"><?php echo htmlspecialchars($row['szeLeiras']); ?></p>
            <p><?php echo htmlspecialchars($row['szeLeiras2']); ?></p>
            <div class="rating-container">

                <h2>Értékeld az edzőt:</h2>
                <form id="rating-form" action="actions/star_submit.php" target="kisablak" method="POST">
                    <div class="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <input type="hidden" id="star-value" name="star_value" value="0">
                    <input name="eid" value="<?php echo htmlspecialchars($_GET['eid']); ?>" type="hidden">
                    <button onclick="" type="submit" class="btn btn-warning" style="font-size:20px;">Értékelés beküldése</button>
                </form>
                <p id="error" style="color:red;"></p>
            </div>

            <script>
                // Add event listeners to stars
                document.querySelectorAll('.star').forEach(star => {
                    star.addEventListener('click', function() {
                        // Get the value of the clicked star
                        const starValue = this.getAttribute('data-value');

                        // Update the hidden input field with the star value
                        document.getElementById('star-value').value = starValue;

                        // Optionally, you can visually highlight the stars up to the clicked one
                        document.querySelectorAll('.star').forEach(s => {
                            s.style.color = (parseInt(s.getAttribute('data-value')) <= starValue) ? 'gold' : 'gray';
                        });
                    });
                });
                // Validate form submission
                document.getElementById('rating-form').addEventListener('submit', function(event) {
                    const starValue = document.getElementById('star-value').value;

                    // Check if no star is selected
                    if (starValue === "0") {
                        event.preventDefault(); // Prevent form submission
                        alert("Kérlek válassz egy csillagot!");
                    }
                });
            </script>




        </div>


        <div class="col">
            <img src="<?php echo isset($szeKepek['profilkep']) ? $szeKepek['profilkep'] : 'images/edzo.webp'; ?>" alt="Profilkép">
        </div>
    <?php endwhile; ?>
</div>