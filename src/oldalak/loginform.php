<form class='form bg-transparentblack text-light p-4 mt-4' action='actions/loginaction.php' method='post' target='kisablak'>
    <h1 class='text-warning'><?= $languageContent["login"]?></h1>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>
    <div class='mb-3' >
        <label for='InputUsername' class='form-label'><?= $languageContent["nameOrEmail"]?></label>
        <input type='text' class='form-control form-control-dark' id='InputUsername' name='username'>
    </div>
    <div class='mb-3' id='password-container'>
        <label for='InputPassword' class='form-label'><?= $languageContent["pw"]?></label>
        <input type='password' class='form-control form-control-dark' id='InputPassword' name='password'>
        <img style='margin-top:17px;' src='images/hidden.png' id='eyeIcon' class='eye-icon' alt='Show/Hide Password'>
    </div>
    <button type='submit' class='btn btn-warning w-100'><?= $languageContent["login"]?></button>
</form>