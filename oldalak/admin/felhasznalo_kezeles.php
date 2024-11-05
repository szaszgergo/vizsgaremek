<div class="container mt-5 bg-dark  ">
    <h2>Felhasználók kezelése</h2>

    <h3 class="mt-5">Létező felhasználók</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="row">
        <div class="col-md-2">Felhasználónév</div>
        <div class="col-md-2">Profilkép</div>
        <div class="col-md-2">email</div>
        <div class="col-md-2">Szerep</div>
        <div class="col-md-1">Komment</div>
        <div class="col-md-3 text-end"><button class="btn btn-primary btn-new">+</button></div>
    </div>


    <?php
    $result = sqlcall("SELECT * FROM user");
    while ($row = $result->fetch_assoc()): ?>
        <div class="row" id="inputcontainer">
            <form action="actions/admin/edit.php" target="kisablak" method="post" class="row g-2">
                <div class="col-md-2">
                    <input type="text" name="ufelhasznalonev" value="<?php echo $row['uFelhasznalonev']; ?>" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <img alt="Profile Image" class="profile-image img-fluid"
                        src="profile_pic/<?= empty($row['uProfilePic']) ? '../images/pic.png' : $row['uProfilePic'] ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" name="uemail" value="<?php echo $row['uemail']; ?>" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="text" name="ustatus" value="<?php echo $row['uStatus']; ?>" readonly class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="text" name="ukomment" value="<?php echo $row['uKomment']; ?>" readonly class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                    <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                </div>
                <div class="col-md-1">
                    <input value="<?php echo $row['uID']?>" name="uid" type="hidden" >
                    <button type="submit" formaction="actions/admin/delete.php" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    <?php endwhile; ?>
</div>