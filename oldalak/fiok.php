<?php
$adatok = getUserInfo();
$jegy = getUserJegyek();
if (isset($jegy)) {
    $jtid = $jegy[2];
    $tipusadatok = getJegyTipusAdatok($jtid);
    $szoveg = "<img src='https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $adatok[1]?>&size=4000x4000&margin=5;' alt='<?php echo $adatok[1]?>' title='JEGY' class='qr bg-dark' /> <br>$tipusadatok[1] <br> $jegy[4]";
} else{
    $szoveg = "<h1>Nincs érvényes jegyed</h1> <a class='btn btn-warning' href='?o=jegyvasarlasform'>Vásárlás</a>";
}

?>
<div class="row ">
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
        <button type="submit" class="btn btn-warning w-100">Adatok mentése</button>
    </form>
</div>
<div class="col-md-4 jegy">
    <?php echo $szoveg;?>
</div>
</div>