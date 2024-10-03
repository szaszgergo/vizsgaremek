<?php
$adatok = getUserInfo();


?>
<form class="form bg-dark text-light fiok" action="actions/registeraction.php" method=post target='kisablak'>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>
    <div class="mb-3">
        <label for="InputUsername" class="form-label">Felhasználónév</label>
        <input value="<?php echo $adatok[2]?>" type="text" class="form-control form-control-dark" id="InputUsername" name="username" maxlength="100" readonly>
    </div>
    <div class="mb-3">
        <label for="InputEmail" class="form-label">Email cím</label>
        <input value="<?php echo $adatok[3]?>" type="email" class="form-control form-control-dark" id="InputEmail" name="email" maxlength="256" readonly>
    </div>
    <div class="mb-3">
        <label for="InputDate" class="form-label">Születési dátum</label>
        <input value="<?php echo $adatok[5]?>" type="date" class="form-control form-control-dark" id="InputDate" name="date" readonly>
    </div>
</form>
    