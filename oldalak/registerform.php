<form class="form bg-dark text-light p-4 mt-4" action="actions/registeraction.php" method=post target='kisablak'>
    <h1 class="text-warning">Regisztráció</h1>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>
    <div class="mb-3">
        <label for="InputUsername" class="form-label">Felhasználónév</label>
        <input type="text" class="form-control form-control-dark" id="InputUsername" name="username" maxlength="100" required>
    </div>
    <div class="mb-3">
        <label for="InputEmail" class="form-label">Email cím</label>
        <input type="email" class="form-control form-control-dark" id="InputEmail" name="email" maxlength="256" required>
    </div>
    <div class="mb-3" id="password-container">
        <label for="InputPassword" class="form-label">Jelszó</label>
        <input type="password" class="form-control form-control-dark" id="InputPassword" name="password" maxlength="64" required>
        <img style="margin-top:5px;" src="images/hidden.png" id="eyeIcon" class="eye-icon" alt="Show/Hide Password">
        <div id="passHelp" class="form-text text-warning">64 hossz, specialis karakterek</div>
    </div>
    <div class="mb-3">
        <label for="InputDate" class="form-label">Születési dátum</label>
        <input type="date" class="form-control form-control-dark" id="InputDate" name="date" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="elfogadas" required>
        <label class="form-check-label" for="elfogadas">Elfogadom a cuccokat <a href="" class="text-warning">adawfawfafwfaw</a></label>
    </div>
    <button type="submit" class="btn btn-warning w-100">Regisztrálok</button>
</form>
    