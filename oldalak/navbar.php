<nav class="navbar navbar-dark  bg-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand text-warning fs-2" href="./"><img src="images/logo.png" alt="LiftZone" title="LiftZone" class="logo"></a>
        <div class="ms-auto d-flex align-items-end">
            <p id="nav_p">4222 Budapest, Utca u. 117.</p>
            <p id="nav_p">6:00 - 23:00</p>
        </div>
        <form class="d-flex align-items-center">
            <?php if (!isset($_SESSION["loggedin"])): ?>
                <a class="btn btn-warning m-2" href="./?o=loginform">Bejelentkezés </a>
                <a class="btn btn-warning m-2" href="./?o=registerform">Regisztráció</a>
            <?php else: ?>
            <!-- Felhasználói profil információ -->
                <span class="navbar-text">
                    <a href="./?o=fiok" id="felhasznalo_nev" class="d-flex align-items-center">
                        <?= getUserInfo()[2] ?>
                        <img alt="Profile Image" class="profile-image" src="profile_pic/<?= empty(getUserInfo()[11]) ? '../images/pic.png' : getUserInfo()[11] ?>"/>
                    </a>
                </span>
                <a href="actions/logout.php" class="btn btn-danger m-2">Kijelentkezés</a>
            <?php endif; ?>
            <!-- Hamburger ikon -->
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="hamburgerMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hamburgerMenu">
                    <li><a class="dropdown-item" href="./?o=arak">Áraink</a></li>
                    <li><a class="dropdown-item" href="#">Edzők</a></li>
                    <li><a class="dropdown-item" href="#">Galéria</a></li>
                    <li><a class="dropdown-item" href="#">Gyakori kérdések</a></li>
                </ul>
            </div>
        </form>
    </div>
</nav>