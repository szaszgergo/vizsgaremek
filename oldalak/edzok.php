<style>
    .row {
        font-size: 20px;
    }

    .col {
        border-radius: 30px;
        height: 40%;
    }

    h1 {
        text-align: left;
    }

    .col a {
        background-color: black;
        border-radius: 20px;
        padding: 10px;
    }

    /* Új stílusok a szövegekhez */
    .col p {
        margin-bottom: 15px;
        /* Térköz a bekezdések között */
        line-height: 1.5;
        /* Magasság a sorok között */
        color: #ffffff;
        /* Fehér szín a szövegnek */
    }

    .col h3 {
        margin-top: 20px;
        /* Térköz a h3 elem felett */
        color: #ffc107;
        /* Bootstrap warning szín */
    }

    /* A kérdések és motiváló szövegek stílusának javítása */
    .col .motivational-text {
        font-weight: bold;
        /* Félkövér szöveg */
        font-style: italic;
        /* Dőlt betűk */
        margin: 20px 0;
        /* Térköz */
        color: #ffda60;
        /* Világosabb narancssárga szín */
    }

    .col img {
        width: 700px;
        height: 850px;
        border-radius: 10%;
        margin-top: 10px;
    }

    .socialicon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #000;
        border-radius: 50%;
        font-size: 24px;
    }

    .social-icons-container {
        display: flex;
        justify-content: left;
        gap: 10px;
    }

    /* style.css */
    .rating-container {
        text-align: center;
        margin-top: 50px;
    }

    .stars {
        font-size: 2em;
        cursor: pointer;
    }

    .star {
        color: gray;
    }

    .star.selected {
        color: gold;
    }
</style>
<div class="row">
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

                    <button type="submit">Értékelés beküldése</button>
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