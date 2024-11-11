<div class="container mt-5">
    <h2>Felhasználók kezelése</h2>
    
    <h3 class="mt-5">Létező felhasználók</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="table">
    <div class="row">
        <div class="col-md-2">Státusz</div>
        <div class="col-md-2">Felhasználónév</div>
        <div class="col-md-2">Profilkép</div>
        <div class="col-md-1">email</div>
        <div class="col-md-1">telefonszám</div>
        <div class="col-md-1">Komment</div>
        <div class="col-md-3 text-end">Új hozzáadása: <button class="btn btn-primary btn-new">+</button></div>
    </div>


    <?php
    $result = sqlcall("SELECT * FROM user WHERE uSzerep = 3");
    while ($row = $result->fetch_assoc()):
        $isDeleted = ($row['uStatus'] === 'Deleted');
        $kapcsolas = sqlcall("SELECT * FROM szemelyi_Edzok WHERE szeUID = $row[uID]");
        $adatok = $kapcsolas->fetch_assoc();
        ?>
        <div class="row <?php echo $isDeleted ? 'deleted-row' : ''; ?>" id="inputcontainer">
            <form action="actions/admin/edit.php" target="kisablak" method="post" class="row g-2">
                <input name="tabla" value="user" type="hidden" >
                <input name="primary_key" type="hidden"  value="uID">
                <input name="id"  value="<?php echo htmlspecialchars($row['uID']); ?>" type="hidden">

                <div class="col-md-2">
                    <?php if ($isDeleted): ?>
                        <span><?php echo htmlspecialchars($row['uStatus']); ?></span>
                    <?php else: ?>
                        <input type="text" name="uStatus" value="<?php echo htmlspecialchars($row['uStatus']); ?>" readonly class="form-control">
                    <?php endif; ?>
                </div>

                <div class="col-md-2">
                    <?php if ($isDeleted): ?>
                        <span><?php echo htmlspecialchars($row['uFelhasznalonev']); ?></span>
                    <?php else: ?>
                        <input type="text" name="uFelhasznalonev" value="<?php echo htmlspecialchars($row['uFelhasznalonev']); ?>" readonly class="form-control">
                    <?php endif; ?>
                </div>

                <div class="col-md-2 position-relative">
                    <?php if (!empty($row['uProfilePic'])): ?>
                        <div class="profile-pic-container">
                            <img alt="Profile Image" class="profile-image img-fluid"
                                src="profile_pic/<?php echo htmlspecialchars($row['uProfilePic']); ?>">
                            <span class="remove-icon" onclick="removeProfilePicture(<?php echo $row['uID']; ?>)">✕</span>
                        </div>
                    <?php else: ?>
                        <img alt="Profile Image" class="profile-image img-fluid" src="images/pic.png">
                    <?php endif; ?>
                </div>

                <div class="col-md-1">
                    <?php if ($isDeleted): ?>
                        <span><?php echo htmlspecialchars($row['uemail']); ?></span>
                    <?php else: ?>
                        <input type="text" name="uemail" value="<?php echo htmlspecialchars($row['uemail']); ?>" readonly class="form-control">
                    <?php endif; ?>
                </div>

                <div class="col-md-1">
                    <?php if ($isDeleted): ?>
                        <span><?php echo htmlspecialchars($adatok['szeTelefon']); ?></span>
                    <?php else: ?>
                        <input type="text" name="szeTelefon" value="<?php echo htmlspecialchars($adatok['szeTelefon']); ?>" readonly class="form-control">
                    <?php endif; ?>
                </div>

                <div class="col-md-2">
                    <?php if ($isDeleted): ?>
                        <span><?php echo htmlspecialchars($row['uKomment']); ?></span>
                    <?php else: ?>
                        <input type="text" name="uKomment" value="<?php echo htmlspecialchars($row['uKomment']); ?>" readonly class="form-control">
                    <?php endif; ?>
                </div>

                <?php if (!$isDeleted): ?>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                        <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" formaction="actions/admin/delete.php" class="btn btn-danger">Delete</button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    <?php endwhile; ?>
<script>
function removeProfilePicture(userId) {
    if (confirm("Biztos ki akarod törölni a felhasználó képét?")) {
        fetch('actions/admin/remove_profile_picture.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userId: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Profilkép sikeresen törölve.");
                location.reload();
            } else {
                alert("Sikertelen törlés.");
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>