<?php
if (isset($_SESSION["loggedin"])) {
    echo "<h1>Már be vagy jelentkezve</h1>";
} else{
    echo "
    <form class='form bg-dark text-light p-4 mt-4' action='actions/loginaction.php' method='post' target='kisablak'>
        <h1 class='text-warning'>Bejelentkezés</h1>
        <div id='error-message' class='alert alert-danger' style='display: none;'></div>

        <div class='mb-3'>
            <label for='InputUsername' class='form-label'>Felhasználónév/email</label>
            <input type='text' class='form-control form-control-dark' id='InputUsername' name='username'>
        </div>
        <div class='mb-3'>
            <label for='InputPassword' class='form-label'>Jelszó</label>
            <input type='password' class='form-control form-control-dark' id='InputPassword' name='password'>
        </div>
        <button type='submit' class='btn btn-warning w-100'>Bejelentkezek</button>
    </form>
    ";}


?>
