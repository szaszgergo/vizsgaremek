<?php
// CAPTCHA generálása
function generateCaptcha() {
    $szam1 = rand(1, 9);
    $szam2 = rand(1, 9);
    $_SESSION['eredmeny'] = $szam1 + $szam2;
    return [$szam1, $szam2];
}

list($szam1, $szam2) = generateCaptcha();

// Rossz captcha válasz esetén új számokat generál
if (isset($_POST['user_eredmeny']) && $_POST['user_eredmeny'] != $_SESSION['eredmeny']) {
    list($szam1, $szam2) = generateCaptcha();
}
?>

<form class="form bg-transparentblack text-light p-4 mt-4" action="actions/regisztracio_feldolgozas.php" method="post" target='kisablak'>

    <h1 class="text-warning"><?= $languageContent["signup"] ?></h1>

    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="mb-3">
        <label for="InputUsername" class="form-label"><?= $languageContent["usernameLabel"] ?></label>
        <input type="text" class="form-control form-control-dark" id="InputUsername" name="username" maxlength="100" required>
    </div>

    <div class="mb-3">
        <label for="InputEmail" class="form-label"><?= $languageContent["emailLabel"] ?></label>
        <input type="email" class="form-control form-control-dark" id="InputEmail" name="email" maxlength="256" required>
    </div>

    <div class="mb-3" id="password-container">
        <label for="InputPassword" class="form-label"><?= $languageContent["pwLabel"] ?></label>
        <input type="password" class="form-control form-control-dark" id="InputPassword" name="password" maxlength="64" required>
        <img style="margin-top:5px;" src="images/hidden.png" id="eyeIcon" class="eye-icon" alt="Show/Hide Password">
        <div id="passHelp" class="form-text text-warning"><?= $languageContent["pwLeiras"] ?></div>
    </div>
    
    <div class="mb-3" id="password-container">
        <label for="InputPassword" class="form-label"><?= $languageContent["pwLabel"] ?></label>
        <input type="password" class="form-control form-control-dark" id="InputPassword" name="retype_password" maxlength="64" required>
        <img style="margin-top:5px;" src="images/hidden.png" id="eyeIcon" class="eye-icon" alt="Show/Hide Password">
        <div id="passHelp" class="form-text text-warning"><?= $languageContent["pwLeiras"] ?></div>
    </div>

    <div class="mb-3">
        <label for="InputDate" class="form-label"><?= $languageContent["birthdateLabel"] ?></label>
        <input type="date" class="form-control form-control-dark" id="InputDate" name="date" required>
    </div>

    <div class="mb-3">
        <label for="InputCaptcha" class="form-label"><?= $languageContent["captchaLabel"] ?> <?php echo "$szam1 + $szam2 = "; ?></label>
        <input type="text" name="user_eredmeny" required>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="elfogadas" required>
        <label class="form-check-label" for="elfogadas"><?= $languageContent["elfogadomLabel"] ?></label>
    </div>

    <a href="#error-message"><button type="submit" class="btn btn-warning w-100"><?= $languageContent["signup"] ?></button></a>

</form>

<script src="js/captcha.js"></script>