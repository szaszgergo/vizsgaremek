<div class="row">
    <div class="col-md-12"><p><h3><b>Vélemények</b></h3></p></div>
</div>
<?php
$oldalak = sqlcall("
    SELECT edzok_kommentek.ekID, edzok_kommentek.ekKomment, edzok_kommentek.ekDatum, user.uemail
    FROM edzok_kommentek
    INNER JOIN user ON edzok_kommentek.ekUserID = user.uID
    ORDER BY edzok_kommentek.ekDatum DESC;
");

while ($row = $oldalak->fetch_assoc()): ?>
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
                <input type="hidden" name="action" value="elutasitas">
                <button type="submit" class="btn btn-danger">✖</button>
            </form>
       </div>
    </div>
<?php endwhile; ?>