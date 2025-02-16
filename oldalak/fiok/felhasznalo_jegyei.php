<div class="row fiokrow">
    <div class="col-md-12 profile-container">
        <h1>Jegyeid:</h1>

        <?php 
        $jegyek = getUserJegyek(); 
        $aktivjegy = getUserJegy();
        ?>

        <?php if ($aktivjegy): ?>
            <?php 
                $tipus = getJegyTipusAdatok($aktivjegy['jtID']); 
            ?>
            <h2>Aktív jegyed:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Jegy Típusa</th>
                        <th>Állapot</th>
                        <th>Művelet</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($tipus[1]) ?></td>
                        <td><span class="badge bg-success">Aktív</span></td>
                        <td>
                            <form method="post" action="../actions/jegy_deaktivalas.php" target="kisablak">
                                <input type="hidden" name="jID" value="<?= $aktivjegy['jID'] ?>">
                                <button type="submit" class="btn btn-danger">Lemondás</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nincs aktív jegyed.</p>
        <?php endif; ?>

        <?php if ($jegyek->num_rows > 0): ?>
            <h2>Elérhető jegyeid:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Jegy Típusa</th>
                        <th>Állapot</th>
                        <th>Művelet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($pass = $jegyek->fetch_assoc()): ?>
                        <?php 
                            $tipus = getJegyTipusAdatok($pass['jtID']);
                            $status = $pass['jStatus'];
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($tipus[1]) ?></td>
                            <td>
                                <?php if ($status == 2): ?>
                                    <span class="badge bg-secondary">Inaktív</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Lejárt</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($status == 2): ?>
                                    <form method="post" action="../actions/jegy_aktivalas.php" target="kisablak">
                                        <input type="hidden" name="jID" value="<?= $pass['jID'] ?>">
                                        <button type="submit" class="btn btn-primary">Aktiválás</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nincs elérhető inaktív vagy lejárt jegyed.</p>
        <?php endif; ?>

    </div>
</div>
