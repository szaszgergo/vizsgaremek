  <div class="container text mt-3  p-5 mainsite">
    <section class="m-5 p-4">
        <div class="row mb-5" style="text-align:center;">
            <h1><?= $languageContent['main1'] ?></h1>
            <p><?= $languageContent['main2'] ?></p>
            <div class="mb-3">
                <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-warning"><?= $languageContent['main3'] ?></button>
            </div>
        </div>
        <div class="row mb-5">
        <h1 class="mb-4"><?= $languageContent['main4'] ?></h1>
                <div class="col-md-6" style="text-align:center;">
                        <i class='fas fa-burn mb-3' style='font-size:36px'></i>
                        <h4><?= $languageContent['main5'] ?></h4>
                        <p><?= $languageContent['main6'] ?></p>
                </div>
                <div class="col-md-6" style="text-align:center;">
                        <i class="fa-solid fa-heart mb-3" style="font-size:36px"></i>
                        <h4><?= $languageContent['main7'] ?></h4>
                        <p><?= $languageContent['main8'] ?></p>
                </div>
                <i class="fa fa-arrow-down" style="font-size:36px; text-align:center;"></i>
        </div>
    </section>

    <section class="m-5 p-5">
        <div class="row mb-5">
                <div class="col-md-6" style="text-align:left;">
                        <h1  style="text-align:left;"><?= $languageContent['main9'] ?></h1>
                        <p><?= $languageContent['main10'] ?></p>
                        <p><a href="mailto:info@liftzone.hu" class="text-warning"><?= $languageContent['main11'] ?></a></p>
                        <p><?= $languageContent['main12'] ?></p>
                        <p><?= $languageContent['main13'] ?></p>
                </div>

                <div class="col-md-6" style="text-align: right;">
                    <h1  style="text-align:left;"><?= $languageContent['main14'] ?></h1>
                    <div id="map"></div>
                </div>
        </div>
    </section>
   <section id="gepek">
        <section  class="m-5 p-5">
            <div class="row mb-5">
                    <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                            <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['main15'] ?></h1>
                            <p><?= $languageContent['main16'] ?></p>
                            <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2"><?= $languageContent['main17'] ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-md-6"></div>
            </div>
        </section>

        <section class="m-5 p-5">
            <div class="row mb-5">
                <div class="col-md-6"></div>
                    <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                            <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['main18'] ?></h1>
                            <p><?= $languageContent['main19'] ?></p>
                            <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2"><?= $languageContent['main20'] ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
            </div>
        </section>
    </section>

    <section>
        <div class="row">
            <h1><?= $languageContent['main21'] ?></h1>
            <div class="logos"> 
                <div class="logos-slide">
                    <img src="./images/sponsor1.webp" />
                    <img src="./images/sponsor2.webp" />
                    <img src="./images/sponsor3.webp" />
                    <img src="./images/sponsor4.webp" />
                    <img src="./images/sponsor5.webp" />
                    <img src="./images/sponsor6.webp" />
                    <img src="./images/sponsor7.webp" />
                    <img src="./images/sponsor8.webp" />
                </div>
            </div>
        </div>
        <div class="row">
            <h1><?= $languageContent['main22'] ?></h1>
            <div class="logos"> 
                <div class="logos-slide edzo">
                    <img src="./images/edzo.webp" />
                    <img src="./images/edzo2.webp" />
                    <img src="./images/edzo3.webp" />
                    <img src="./images/edzo4.webp" />
                    <img src="./images/edzo.webp" />
                    <img src="./images/edzo2.webp" />
                    <img src="./images/edzo4.webp" />
                </div>
            </div>
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
