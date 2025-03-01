<div class="modal fade" id="login2fa" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class='text-warning'><?= $languageContent["confirmYourPassword"] ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="actions/2faAction.php" method="POST" target="kisablak">
                    <div id='error-message' class='alert alert-danger' style='display: none;'></div>
                    <div class='mb-3'>
                        <label for='felhasznalonev' class='form-label'><?= $languageContent["nameOrEmail"] ?></label>
                        <input type='text' class='form-control form-control-dark' name='felhasznalonev'>
                    </div>
                    <div class='mb-3' id='password-container'>
                        <label for='InputPassword' class='form-label'><?= $languageContent["pw"] ?></label>
                        <input type='password' class='form-control form-control-dark' name='jelszo' id="InputPassword">
                        <img style='margin-top:17px;' src='images/hidden.png' id='eyeIcon' class='eye-icon' alt='Show/Hide Password'>
                    </div>
            </div>

            <div class="modal-footer">

                <button type='submit' class='btn btn-warning w-100'><?= $languageContent["confirm"] ?></button>
                </form>
            </div>
        </div>
    </div>
</div>