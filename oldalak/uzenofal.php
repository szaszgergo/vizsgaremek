<?php
$adatok = sqlcall("
SELECT uzenoCim, uzenoSzoveg, uzenoDatum, uzenoKep
FROM uzenofal
ORDER BY uzenoDatum DESC;
");
?>
<h1 id="uzenoCim">Üzenőfal</h1>
<br>
<?php while($row = $adatok->fetch_assoc()): ?>
<div class="blokk">
    <h4 class="belsoCim"><strong><?php echo $row["uzenoCim"] ?></strong></h4>
    <p class="belsoSzoveg"><?php echo $row["uzenoSzoveg"] ?></p>
    <p class="belsoDatum"><small><em><?php echo $row["uzenoDatum"] ?></small></em></p>
    <?php if (!empty($row["uzenoKep"])): ?>
        <img src="images/uzenofal/<?php echo str_replace('C:/xampp/htdocs/vizsgaremek/', '', $row["uzenoKep"]); ?>" class="uzenofalKep">
    <?php endif; ?>
</div>
<?php endwhile; ?>