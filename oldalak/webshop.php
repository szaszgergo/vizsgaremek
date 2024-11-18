<div class="bg-transparentblack">
<?php
$termekek = sqlcall("SELECT * FROM termekek");
while ($termek = $termekek->fetch_assoc()):
?>
    <div class="card" style="width: 18rem; margin: 1rem;">
        <img src="./images/termekek/<?php echo $termek['teID']; ?>/main.png" class="card-img-top" alt="<?php echo htmlspecialchars($termek['teNev']); ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($termek['teNev']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($termek['teLeiras']); ?></p>
            <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($termek['teAr']); ?> Ft</p>
            <a href="?o=termek&id=<?php echo $termek['teID']; ?>" class="btn btn-primary">View Details</a>
        </div>
    </div>
<?php endwhile; ?>
</div>