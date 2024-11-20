  <div class="container text mt-3  p-5 mainsite">
      <section class="m-5 p-4">
          <div class="row mb-5" style="text-align:center;">
              <h1><?= $languageContent['udv'] ?></h1>
              <p><?= $languageContent['hypeSzoveg'] ?></p>
              <div class="mb-3">
                  <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-warning"><?= $languageContent['csatlakozz'] ?></button>
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

      <section class="m-5 p-5">
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
      <section id="gepek">
          <section class="m-5 p-5">
              <div class="row  mb-5">
                  <div class="col-md-6 p-4 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                      <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['modernGepek'] ?></h1>
                      <p><?= $languageContent['modernGepekSzovege'] ?></p>
                      <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2"><?= $languageContent['ar'] ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                  </div>
                  <div class="col-md-6"></div>
              </div>
          </section>

          <section class="m-5 p-5">
              <div class="row mb-5">
                  <div class="col-md-6"></div>
                  <div class="col-md-6 p-4 bg-warning text-dark" style="text-align:left; border-radius:20px;">
                      <h1 style="text-align:left; text-transform: uppercase;"><?= $languageContent['fitnessCardio'] ?></h1>
                      <p><?= $languageContent['fitnessCardioSzovege'] ?></p>
                      <button onclick='window.top.location.href = "./?o=arak";' class="btn btn-dark text-white mb-2"><?= $languageContent['info'] ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                  </div>
              </div>
          </section>
      </section>

      <section class="sliders">
          <div class="row">
              <h1><?= $languageContent['szponzorok'] ?></h1>
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




          <div class="logos">
          <h1><?= $languageContent['partnerek'] ?></h1>

              <div class="row logos-slide edzo m-1">
                  <?php
                    $result = sqlcall("SELECT * FROM szemelyi_edzok");
                    while ($row = $result->fetch_assoc()):
                        $szeKepek = json_decode($row['szeKepek'], true);
                    ?>
                      <div class="edzo-item">
                        <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>">
                              <img src="./<?php echo isset($szeKepek['profilkep']) ? $szeKepek['profilkep'] : 'images/default.jpg'; ?>" alt="Edző képe" />
                          </a>
                          <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>" class="edzo-nev"><?php echo htmlspecialchars($row['szeuFelhasznalonev']); ?><br>
                              <button type="button" class="btn btn-warning tovabb-gomb"><?= $languageContent['tovabbgomb'] ?></button>
                          </a>
                      </div>
                  <?php endwhile; ?>
              </div>
          </div>

      </section>
    
            <h1>Írj nekünk!</h1>
           
            <p> Kérdéseiddel, észrevételekkel és problémákkal
            kapcsolatban kérlek írj e-mailt vagy írj itt. Ne habozz lépj velünk kapcsolatba!</p>
            <div class="contact-form mt-4 p-3 rounded" style="background-color: var(--transparent-black); max-width: 400px; margin: auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
                <form action="actions/uzenetKuldesIr.php" method="post" target="kisablak">
                    <div class="form-group">
                        <label for="email" class="text-white">Email cím:</label>
                        <input type="email" name="email" id="email" class="form-control" style="border-radius: 5px;" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="message" class="text-white">Üzenet:</label>
                        <textarea name="message" id="message" rows="3" class="form-control" style="border-radius: 5px; resize: none;" required maxlength="300"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning mt-3 w-100" style="border-radius: 20px;">Küldés</button>
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
