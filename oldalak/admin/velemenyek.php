<?php
$oldalak = sqlcall("
    SELECT edzok_kommentek.ekID, edzok_kommentek.ekKomment, edzok_kommentek.ekDatum, user.uemail
    FROM edzok_kommentek
    INNER JOIN user ON edzok_kommentek.ekUserID = user.uID
    ORDER BY edzok_kommentek.ekDatum DESC;
");
?>
<div id="all-comments" style="display: none;">
    <?php while ($row = $oldalak->fetch_assoc()): ?>
        <div class="comment">
            <div class="table row">
                <div class="col-md-10">
                    <p><strong>Email:</strong> <?php echo $row['uemail']; ?></p>
                    <p><strong>Komment:</strong> <?php echo $row['ekKomment']; ?></p>
                    <p><small><em>Dátum: <?php echo $row['ekDatum']; ?></em></small></p>
                </div>
                <div class="col-md-1">
                    <form method="post" action="actions/velemeny_feldolgozas.php" target="kisablak">
                        <input type="hidden" name="ekID" value="<?php echo $row['ekID']; ?>">
                        <input type="hidden" name="accept" value="elfogadas">
                        <button type="submit" class="btn btn-success">✔</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="post" action="actions/velemeny_feldolgozas.php" target="kisablak">
                        <input type="hidden" name="ekID" value="<?php echo $row['ekID']; ?>">
                        <input type="hidden" name="deny" value="elutasitas">
                        <button type="submit" class="btn btn-danger">✖</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<div id="comments-container"></div>

<div id="pagination-controls" style="text-align: center; margin-top: 20px;"></div>

<script src="js/kommentek.js"></script>