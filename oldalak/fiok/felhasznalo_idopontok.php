<div class="row">
    <div class="bg-transparentblack m-4">
        <?php
        if (isset($_SESSION["szerep"])):
            if ($_SESSION["szerep"] == "user"):
                $sql2 = "SELECT eb_idopont, ebUID, ebEID FROM edzo_beosztas WHERE eb_Status = 1 AND ebUID = ? AND eb_idopont >= CURDATE()";
                $result2 = sqlcall($sql2, 'i', [$_SESSION['uid']]);

                ?>
                <h2>Időpontok<br></h2>
                <div style='display: flex; flex-wrap: wrap; gap: 10px;'>
                    <?php
                    while ($row2 = $result2->fetch_assoc()):
                        $idopont = $row2['eb_idopont'];
                        $ebUID = $row2['ebUID'];
                        $ebEID = $row2['ebEID'];

                        // Harmadik lekérdezés: felhasználó adatai
                        $sql3 = "SELECT uFelhasznalonev, uemail FROM user WHERE uid = ?";
                        $result3 = sqlcall($sql3, 'i', [$ebUID]);
                        $user = $result3->fetch_assoc();

                        if ($user):
                            $felhasznaloNev = htmlspecialchars($user['uFelhasznalonev']);
                            $email = htmlspecialchars($user['uemail']);
                            ?>
                            <div class='bg-transparentblack m-1 p-1'
                                style='border: 1px solid #ccc; padding: 10px; border-radius: 5px; width: 26%; position: relative;'>
                                <h3>Időpont: <?php echo $idopont; ?></h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Felhasználó neve:</strong> <?php echo $felhasznaloNev; ?></p>
                                        <p><strong>E-mail:</strong> <?php echo $email; ?></p>
                                    </div>
                                </div>
                                <!-- Törlés gomb jobbra és alulra -->
                                <div style="position: absolute; bottom: 10px; right: 10px;">
                                    <form action="./actions/edzo_beosztas_lemodasa.php" target="kisablak" method="POST">
                                        <input type="hidden" name="ebUID" value="<?php echo $ebUID; ?>">
                                        <input type="hidden" name="idopont" value="<?php echo $idopont; ?>">
                                        <input type="hidden" name="ebEID" value="<?php echo $ebEID; ?>">

                                        <button type="submit" class="btn btn-danger">Törlés</button>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?>
                            <div style='border: 1px solid #ccc; padding: 10px; border-radius: 5px; width: 300px;'>
                                <h3>Időpont: <?php echo $idopont; ?></h3>
                                <p>Nincs elérhető felhasználói adat.</p>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Nincs találat az első lekérdezéshez.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>