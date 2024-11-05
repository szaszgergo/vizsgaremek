<h1>Legtöbbet látogatott oldalak:</h1>
<?php
$oldalak = sqlcall("SELECT nURL, COUNT(nURL) as count FROM `naplo` GROUP BY nURL ORDER BY count DESC;");
while ($row = $oldalak->fetch_assoc()):?>
<div class="row">
    <div class="col-md-6"><p><?php echo $row['nURL'];?></p></div>
    <div class="col-md-6"><p><?php echo $row['count'];?> látogatás</p></div>
</div>


<?php endwhile; ?>

