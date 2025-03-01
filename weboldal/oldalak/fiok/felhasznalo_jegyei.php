<div class="profile-container">
    <h1><?= $languageContent["myPasses"] ?>:</h1>

    <?php
    $jegyek = getUserJegyek();
    $aktivjegy = getUserJegy();
    ?>

    <?php if ($aktivjegy): ?>
        <?php
        $tipus = getJegyTipusAdatok($aktivjegy['jtID']);
        ?>
        <h2><?= $languageContent["activePasses"] ?>:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th><?= $languageContent["passType"] ?></th>
                    <th><?= $languageContent["status"] ?></th>
                    <th><?= $languageContent["action"] ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($tipus["tpNev"]) ?></td>
                    <td><span class="badge bg-success"><?= $languageContent["active"] ?></span></td>
                    <td>
                        <form method="post" action="../actions/jegy_deaktivalas.php" target="kisablak">
                            <input type="hidden" name="jID" value="<?= $aktivjegy['jID'] ?>">
                            <button type="submit" class="btn btn-danger"><?= $languageContent["delete"] ?></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p><?= $languageContent["noActivePass"] ?></p>
    <?php endif; ?>

    <?php if ($jegyek->num_rows > 0): ?>
        <h2><?= $languageContent["availablePasses"] ?>:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th><?= $languageContent["passType"] ?></th>
                    <th><?= $languageContent["status"] ?></th>
                    <th><?= $languageContent["action"] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pass = $jegyek->fetch_assoc()): ?>
                    <?php
                    $tipus = getJegyTipusAdatok($pass['jtID']);
                    $status = $pass['jStatus'];
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($tipus["tpNev"]) ?></td>
                        <td>
                            <?php if ($status == 2): ?>
                                <span class="badge bg-secondary"><?= $languageContent["inactive"] ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?= $languageContent["expired"] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($status == 2): ?>
                                <form method="post" action="../actions/jegy_aktivalas.php" target="kisablak">
                                    <input type="hidden" name="jID" value="<?= $pass['jID'] ?>">
                                    <button type="submit" class="btn btn-primary"><?= $languageContent["activate"] ?></button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><?= $languageContent["noAvailablePasses"] ?></p>
    <?php endif; ?>

</div>