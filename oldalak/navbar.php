<?php
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'hu';
$flagSrc = $lang === 'hu' ? 'images/hu_flag.png' : 'images/us_flag.png'; // Aktuális zászló
$adatok = getUserInfo();
?>

<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand text-warning fs-2" href="./"><img src="images/logo.png" alt="LiftZone" title="LiftZone"
                class="logo"></a>
        <form>
            <div class="row align-items-center">
                <?php if (!isset($_SESSION["uid"])): ?>
                    <div class="col-auto">
                        <a class="btn btn-warning m-2" href="./?o=loginform"><?= $languageContent['loginBtn'] ?></a>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-warning m-2" href="./?o=registerform"><?= $languageContent['signupBtn'] ?></a>
                    </div>
                <?php else: ?>
                    <!-- Felhasználói profil információ -->
                    <div class="col-auto">
                        <span class="navbar-text">
                            <a href="./?o=fiok" id="felhasznalo_nev" class="d-flex align-items-center">
                                <?= $adatok['uFelhasznalonev'] ?>
                                <img alt="Profile Image" class="profile-image"
                                    src="profile_pic/<?= empty($adatok['uProfilePic']) ? '../images/pic.png' : $adatok['uProfilePic'] ?>" />
                            </a>
                        </span>
                    </div>
                    <div class="col-auto">
                        <a href="actions/kijelentkezes.php"
                            class="btn btn-danger m-2"><?= $languageContent['logoutBtn'] ?></a>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] == "admin"): ?>
                    <div class="col-auto">
                        <a class="btn btn-danger m-2" href="?o=admin&a=felhasznalo_kezeles&search=">Admin</a>
                    </div>
                <?php endif; ?>
                <!-- Cart Icon -->
                <div class="col-auto">
                    <div class="btn btn-dark m-2" data-bs-toggle="modal" data-bs-target="#kosarpopup">
                        <i class="fa fa-shopping-cart fa-xl"></i>
                        <?php
                        if (isset($_SESSION['uid'])):
                            require("actions/kosar_tartalom.php");
                            $cartContent = getKosarContent();
                            ?>
                            <span class="kosarszam"><?php echo count($cartContent); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Zászló gomb nyelvváltó menüvel -->
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button"
                            id="languageMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $flagSrc ?>" alt="Language Flag" class="flag-icon" id="selectedFlag">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageMenu">
                            <li id="hungaryOption">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="actions/nyelv_valtoztatas.php?lang=hu"
                                    onclick="switchFlag('images/hu_flag.png')">
                                    <img src="images/hu_flag.png" alt="Hungary" class="flag-icon">
                                    <?= $languageContent['hu'] ?>
                                </a>
                            </li>
                            <li id="usaOption">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="actions/nyelv_valtoztatas.php?lang=en"
                                    onclick="switchFlag('images/us_flag.png')">
                                    <img src="images/us_flag.png" alt="USA" class="flag-icon">
                                    <?= $languageContent['en'] ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Hamburger ikon oldalak menüvel -->
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="hamburgerMenu"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hamburgerMenu">
                            <li><a class="dropdown-item" href="./?o=arak"><?= $languageContent['hambiArak'] ?></a></li>
                            <li><a class="dropdown-item" href="./?o=shop">Webshop</a></li>
                            <?php if (isset($_SESSION["uid"])): ?>
                                <li>
                                    <a class="dropdown-item"  href="?o=felhasznalo_vasarlas">Vásárlások</a>
                                </li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="./?o=galeria"><?= $languageContent['hambiGaleria'] ?></a>
                            </li>
                            <li><a class="dropdown-item" href="./?o=edzokall"><?= $languageContent['hambiEdzok'] ?></a>
                            </li>
                            <li><a class="dropdown-item" href="./?o=faqs"><?= $languageContent['hambiFaqs'] ?></a></li>
                            <li><a class="dropdown-item"
                                    href="./?o=hazirend"><?= $languageContent['hambiHazirend'] ?></a></li>
                            <li><a class="dropdown-item"
                                    href="./?o=uzenofal"><?= $languageContent['hambiUzenofal'] ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>

    </div>
</nav>