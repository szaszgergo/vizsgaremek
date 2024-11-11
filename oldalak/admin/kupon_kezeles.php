<div class="container mt-5">
    <h2>Kuponok kezelése</h2>
    <h3 class="mt-5">Létező kuponok</h3>
    <div class="table">
            <div class="row">
                <div class="col-md-2">Kod</div>
                <div class="col-md-1">Szazalek</div>
                <div class="col-md-2">Osszeg</div>
                <div class="col-md-1">Alkalmak</div>
                <div class="col-md-2">Érvényesség kezdete</div>
                <div class="col-md-2">Érvényesség vége</div>
                <div class="col-md-2"><button class="btn btn-primary btn-new" data-bs-toggle='modal' data-bs-target='#ujkuponpopup'>+</button></div>
                
            </div>

            <?php
            $result = sqlcall("SELECT * FROM kuponok");
            while ($row = $result->fetch_assoc()): ?>
            <div class="row" id="inputcontainer">
                <form action="actions/admin/edit.php" target="kisablak" method="post" class="row g-2">
                    <input name="tabla" value="kuponok" type="hidden" >
                    <input name="primary_key" value="kID" type="hidden">
                    <input name="id"  value="<?php echo htmlspecialchars($row['kID']); ?>" type="hidden">
                    <div class="col-md-2"><input value="<?php echo $row['kKod']; ?>"            name="kKod"         type="text" class="form-control" readonly></div>
                    <div class="col-md-1"><input value="<?php echo $row['kSzazalek']; ?>"       name="kSzazalek"     type="text" class="form-control" readonly></div>
                    <div class="col-md-2"><input value="<?php echo $row['kOsszeg']; ?>"         name="kOsszeg"      type="text" class="form-control" readonly></div>
                    <div class="col-md-1"><input value="<?php echo $row['kAlkalmak']; ?>"       name="kAlkalmak"     type="text" class="form-control" readonly></div>
                    <div class="col-md-2"><input value="<?php echo $row['kErvenyes_tol']; ?>"   name="kErvenyes_tol" type="text" class="form-control" readonly></div>
                    <div class="col-md-2"><input value="<?php echo $row['kErvenyes_ig']; ?>"    name="kErvenyes_ig" type="text" class="form-control" readonly></div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                        <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
            <?php endwhile; ?>
    </div>
</div>
