<?php
$adatok = getUserInfo();
$jegy = getUserJegyek();
if (isset($jegy)) {
    $jtid = $jegy[2];
    $tipusadatok = getJegyTipusAdatok($jtid);
    $szoveg = "<img src='https://api.qrserver.com/v1/create-qr-code/?data=$adatok[1]&size=4000x4000&margin=10;' alt='<?php echo $adatok[1]?>' title='JEGY' class='qr'  />
    <h3>$tipusadatok[1]</h3>
    <h3>$jegy[4]</h3>
    <h3>Használatok száma: $jegy[5]</h3>";
} else{
    $szoveg = "<h1>Nincs érvényes jegyed</h1> <a class='btn btn-warning' href='?o=jegyvasarlasform'>Vásárlás</a>";
}

?>
<div class="row fiokrow">
    <div class="col-md-8 ">
        <form class="form bg-dark text-light fiok" action="actions/updateaction.php" method=post target='kisablak'>
            <div id='error-message' class='alert alert-danger' style='display: none;'></div>
            <div class="mb-3">
                <label for="InputUsername" class="form-label">Felhasználónév</label>
                <input value="<?php echo $adatok[2]?>" type="text" class="form-control form-control-dark" id="InputUsername" name="username" maxlength="100" readonly>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email cím</label>
                <input value="<?php echo $adatok[3]?>" type="email" class="form-control form-control-dark" id="InputEmail" name="email" maxlength="256" >
            </div>
            <div class="mb-3">
                <label for="InputDate" class="form-label">Születési dátum</label>
                <input value="<?php echo $adatok[5]?>" type="date" class="form-control form-control-dark" id="InputDate" name="date" >
            </div>
            <div class="mb-3">
                <!--jelszomodositas.php  -->
              <p>Ha a jelszódat akarod módosítani akkor azt <a id="jelszomodositas" href="?o=jelszomodositas">itt</a> lehet.</p>
            </div>

            <button type="submit" class="btn btn-warning w-100">Adatok mentése</button>
        </form>
    </div>
    <div class="col-md-4 jegy bg-dark">
        <?php echo $szoveg;?>
    </div>
</div>