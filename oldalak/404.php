<style>
.boxok {
    height: 250px;
    width: 250px;
    border-radius: 30px;
    border: black solid 3px;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    transition: border 0.3s ease, color 0.3s ease, transform 0.3s ease; /* Add transition for transform */
}

.boxok:hover {
    border: white solid 3px;
    transform: scale(1.05); /* Increase the size by 5% on hover */
}

.boxok:hover span {
    color: white;
    text-decoration: none;
}

.boxok a {
    color: black;
    transition: color 0.3s ease;
}

.error-container {
    padding: 20px;
}

.row {
    margin-left: 0;
}

.boxok i {
    font-size: 48px;
    margin-bottom: 10px;
}

a {
    margin-top: 50px;
    margin: 0px;
}

.boxok span {
    margin-top: 30px;
    margin-left: 10px;
    font-size: 24px;
}

</style>

<div class="error-container">
    <h1 class="error-title">404</h1>
    <h2 class="error-description text-start">Nincs ilyen oldal!</h2>
    <p class="text-start">Az általad keresett oldal nem található. Kérlek, ellenőrizd az URL-t, vagy válaszd az alábbi lehetőségek egyikét:</p>

    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="row g-0 justify-content-start">
            <div class="row mb-5">
                <div class="col-md-3">
                    <a href="/">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-reply" style="margin-right:2px;"></i><br>
                                <p>Vissza a főoldalra</p>
                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="./?o=adatvedelem">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-lock"></i><br>
                                <p>Adatvédelmi tájékoztató</p>
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="./?o=arak">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-money-bill"></i><br>
                                <p>Áraink</p>
                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="./?o=edzokall">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-person"></i><br>
                                <p>Edzők</p>
                            </span>
                        </div>
                    </a>
                </div>


            </div>

            <div class="row">
                <div class="col-md-3">
                    <a href="./?o=shop">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-cart-shopping"></i><br>
                                <p>Shop</p>
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="./?o=galeria">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-image"></i><br>
                                <p>Galéria</p>
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="./?o=hazirend">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fa-solid fa-clipboard-list"></i><br>
                                <p>Háziszabályok</p>
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="./?o=faqs">
                        <div class="boxok bg-warning m-2 p-1">
                            <span><i class="fas fa-question"></i><br>
                                <p>FAQ</p>
                            </span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div><!-- href="./?o=adatvedelem" -->
</div>