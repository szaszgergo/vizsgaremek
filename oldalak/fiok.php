<?php
$adatok = getUserInfo();
$jegy = getUserJegyek();
if (isset($jegy)) {
    $jtid = $jegy[2];
    $tipusadatok = getJegyTipusAdatok($jtid);
    $src = "https://api.qrserver.com/v1/create-qr-code/?data=$adatok[1]&size=5000x5000&margin=10";
    $remaining = strtotime($jegy[4]) - time();
    $maradek_napok = round($remaining / 86400);
    $szoveg = "
    <div>
    <h3>$tipusadatok[1]</h3>
    <a href='$src'><img src='$src' alt='<?php echo $adatok[1]?>' title='JEGY' class='qr'  /></a>
    <h4>ÉRVÉNYES:</h4>
    <h1 style='color: #ffc107'>$maradek_napok NAP</h1>";
    if (!is_null($jegy[5])) {
        $szoveg .= "<h3>Használatok száma: <span style='color: #ffc107'> $jegy[5]</span></h3></div>";
    }
} else{
    $szoveg = "<h1>Nincs érvényes jegyed</h1> <a class='btn btn-warning' href='?o=jegyvasarlasform'>Vásárlás</a>";
}

?>
<div class="row fiokrow">
    <div class="col-md-8 ">
        <form class="profile-container" action="actions/updateaction.php" method="post" target='kisablak' enctype="multipart/form-data">
        <div id='error-message' class='alert alert-danger' style='display: none;'></div>
        
        <div class="profile-header">
            <img src="<?php $a= 'profile_pic/' . (empty(getUserInfo()[11]) ? '../images/pic.png' : getUserInfo()[11]); echo $a; ?>" alt="Profile Picture">
            <div>
                <h2>Igazi Név</h2>
                <p>@<?php echo $adatok[2] ?></p>
            </div>
            <button type="button" class="edit-btn" id="edit-btn">Szerkesztés</button>
        </div>

        <div class="mb-3">
            <label for="InputUsername" class="form-label">Felhasználónév</label>
            <input value="<?php echo $adatok[2] ?>" type="text" class="form-control fiok-input" id="InputUsername" name="username" maxlength="100" readonly>
        </div>

        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email cím</label>
            <input value="<?php echo $adatok[3] ?>" type="email" class="form-control fiok-input" id="InputEmail" name="email" maxlength="256" readonly>
        </div>

        <div class="mb-3">
            <label for="InputDate" class="form-label">Születési év</label>
            <input value="<?php echo $adatok[5] ?>" type="date" class="form-control fiok-input" id="InputDate" name="date" readonly>
        </div>

        <div class="mb-3">
            <label for="InputPic" class="form-label">Új profilkép</label>
            <input type="file" class="form-control fiok-input" id="InputPic" name="upic" readonly>
        </div>

        <div class="mb-3">
            <p>Ha szeretnél jelszót változtatni azt <a id="jelszomodositas" href="?o=jelszomodositasform">itt</a> teheted meg.</p>
        </div>

        <button style="display: none;" type="submit" class="btn-save" id="btn-save">Változtatások mentése</button>

    </form>
    </div>
    <div class="col-md-4 jegy bg-dark ">
        <?php echo $szoveg;?>
    </div>
    <script src="./js/edit.js"></script>
</div>