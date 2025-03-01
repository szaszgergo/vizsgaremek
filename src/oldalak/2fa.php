<?php
session_start();
?>
<div id="fiokrow" class="row fiokrow">
    <div class="col">
        <form id="jelszoform" class="form bg-transparentblack text-light fiok" action="actions/2fa_verification.php" method="post" target="kisablak">
            <div id='error-message' class='alert alert-danger' style='display: none;'></div>
            <div class="mb-3" id='password-container'>
                <label for="InputPassword" class="form-label">Emailben küldött kód</label>
                <input type="password" class=" form-control form-control-dark" id="InputPassword" name="code" maxlength="100">
                <img style='margin-top:17px;' src='images/hidden.png' id='eyeIcon' class='eye-icon' alt='Show/Hide Password'>
            </div>
            <button type="submit" class="btn btn-warning w-100">Megerősítés</button>
        </form>
    </div>
</div>