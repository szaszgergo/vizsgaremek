
<style>
        #map {
            height: 400px;
            width: 100%;
        }
        
</style>
 <div class="container text mt-3  p-5" style="text-align:left; border-radius:30px;">
    <section class="m-5 p-4">
        <div class="row mb-5" style="text-align:center;">
            <h1>Üdvözlünk a LiftZone Gymnél!</h1>
            <p>Érje el velünk fitneszcéljait. Csatlakozzon motivált egyének közösségéhez, és alakítsa át testét és elméjét.</p>
            <div class="mb-3">
                <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-warning">Csatlakozz</button>
            </div>
        </div>
        <div class="row mb-5">
        <h1 class="mb-4">Miért Edz nálunk?</h1>
                <div class="col-md-6" style="text-align:center;">
                        <i class='fas fa-burn mb-3' style='font-size:36px'></i>
                        <h4>CSOPORTOS ÓRÁK</h4>
                        <p>Profi edzők Akár az összes órát látogathatod 1 bérlettel</p>
                </div>
                <div class="col-md-6" style="text-align:center;">
                        <i class="fa-solid fa-heart mb-3" style="font-size:36px"></i>
                        <h4>EGYÉNI, PRIVÁT, KISCSOPORTOS EDZÉSEK</h4>
                        <p>Étrend és életmód tanácsadás Funkcionális és Crossfit órák</p>
                </div>
                <i class="fa fa-arrow-down" style="font-size:36px; text-align:center;"></i>
        </div>
    </section>

    <section class="m-5 p-5">
        <div class="row mb-5">
                <div class="col-md-6" style="text-align:left;">
                        <h1  style="text-align:left;">Látogass meg minket edzőtermünkben!</h1>
                        <p>Budapest, Jimmy király útja 1, 1112</p>
                        <p><a href="mailto:info@liftzone.hu" class="text-warning">info@liftzone.hu</a></p>
                        <p>+36 50 121 73 04</p>
                        <p>Minden nap a nap 24 órájában várunk, csoportos óráinkat pedig a weboldalon található órarend szerint látogathatod! Reméljük már holnap tagjaink közt köszönthetünk!</p>
                </div>

                <div class="col-md-6" style="text-align: right;">
                    <h1  style="text-align:left;">Térkép</h1>
                    <div id="map"></div>
                </div>
        </div>
    </section>
   <section style="background-image: url(./images/hatter_gym.jpg);">
        <section  class="m-5 p-5">
            <div class="row mb-5">
                    <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                            <h1 style="text-align:left; text-transform: uppercase;">Modern <br> <span>gépek</span></h1>
                            <p>A Chili Fitness-ben a legmodernebb gépekkel találkozhattok. Ezek a gépek találhatók meg a világ legjobb termeiben és mellette ARNOLD, MADONNA most nyíló edzőtermeiben is.</p>
                            <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2">Áraink <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
                        <div class="col-md-6"></div>
            </div>
        </section>

        <section class="m-5 p-5">
            <div class="row mb-5">
                <div class="col-md-6"></div>
                    <div class="col-md-6 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                            <h1 style="text-align:left; text-transform: uppercase;">Fitness <br> <span>& cardio</span></h1>
                            <p>Amennyiben a célod a fogyás, vagy az állóképességed növelése, jó hírünk van. A keményvonalas edzés mellett termünkben kiváló lehetőséged nyílik fitness, cardio és aerob edzések elvégzésére is.</p>
                            <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2">További információ <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
            </div>
        </section>
    </section>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([47.42057489727823, 19.06725467467809], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([47.42057489727823, 19.06725467467809]).addTo(map);

        marker.bindPopup("<b>Csepel</b><br>Edzőtermünk helyszíne.").openPopup();
    </script>
</div>