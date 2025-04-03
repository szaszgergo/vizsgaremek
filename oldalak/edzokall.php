<style>
    .edzo-item {
        position: relative;
        width: 100%;
        height: 400px;
        text-align: center;
        margin: 10px;
        background-color: black;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform-style: preserve-3d;
        transition: transform 2s ease;
    }

    .edzo-item.active {
        transform: rotateY(180deg);
    }

    .edzo-item img {
        width: 100%;
        max-width: 300px;
        height: 300px;
        border-radius: 10px;
        transition: transform 0.5s ease;
    }

    .edzo-nev {
        display: block;
        margin-top: 10px;
        font-size: 18px;
        font-weight: bold;
        color: white;
    }

    .tovabb-gomb {
        margin-top: 10px;
        background-color: #ff9900;
        border-color: #ff9900;
    }

    .row.edzo {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    @media screen and (max-width: 768px) {
        .row.edzo {
            flex-direction: column;
        }
    }

    .col-md-3 {
        flex: 0 0 25%;
        margin-bottom: 15px;
        padding: 10px;
    }

    .thefront,
    .theback {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 15px;
        backface-visibility: hidden;
        overflow: hidden;
    }

    .theback {
        transform: rotateY(180deg);
        background: black;
        color: white;
        text-align: center;
        padding: 20px;
    }
</style>


<div class="logos">
    <h1><?= $languageContent['partnerek'] ?></h1>

    <div class="row edzo m-1">
        <?php
        if (isset($_SESSION["szerep"]) && $_SESSION["szerep"] == "edzo"):
            $result = sqlcall("SELECT * FROM szemelyi_edzok");
        else:
            $result = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeVisibility = 1");
        endif;
        while ($row = $result->fetch_assoc()):
            $szeKepek = json_decode($row['szeKepek'], true);
        ?>
            <div class="col-md-3">
                <div class="edzo-item">
                    <div class="thefront">
                    <img style="margin-top: 1rem;" src="./<?php echo isset($row['szeKepek']) ? $row['szeKepek'] : 'images/default.jpg'; ?>" alt="Edző képe" />
                        <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>" class="edzo-nev">
                            <?php echo htmlspecialchars($row['szeuFelhasznalonev']); ?>
                        </a>
                        <a href="./?o=edzok&eid=<?php echo $row['szeID']; ?>">
                            <button type="button" class="btn btn-warning tovabb-gomb"><?= $languageContent['tovabbgomb'] ?></button>
                        </a>
                    </div>

                    <div class="theback">
                        <h4><i class="fa-solid fa-location-dot" style="font-size:24px;"></i> Csepel</h4><br>
                        <h5><?= $languageContent['tobbInfo'] ?></h5>
                        <div class="row">
                            <div class="col-md-4 p-2 m-2">
                                <p><?= $languageContent['telefon'] ?></p>
                                <p><?= $languageContent['emailLabel'] ?></p>
                                <p><?= $languageContent['vegzettseg'] ?></p>
                            </div>
                            <div class="col-md-6 p-2 m-2">
                                <p><?php echo $row['szeTelefon'] ?></p>
                                <p><?php echo $row['szeEmail'] ?></p>
                                <p>
                                    <?php
                                    echo htmlspecialchars($row['szeVegzetseg']);
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script>
    document.querySelectorAll('.edzo-item').forEach(card => {
        card.addEventListener('click', () => {
            card.classList.toggle('active');
        });
    });
</script>