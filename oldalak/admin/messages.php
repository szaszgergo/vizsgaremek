<div class="row">
    <div class="col-md-6"><p><h3><b>Emailek</b></h3></p></div>
    <div class="col-md-6"><p><h3><b>Üzenetek</b></h3></p></div>
</div>
<?php
$oldalak = sqlcall("SELECT * FROM `messages` ORDER BY mDate DESC;");
while ($row = $oldalak->fetch_assoc()):?>
<div class="row">
    <div class="col-md-6"><p><?php echo $row['mEmail'];?></p></div>
    <div class="col-md-6"><p><?php echo $row['mUzenet'];?></p></div>
</div>

<?php endwhile; ?>