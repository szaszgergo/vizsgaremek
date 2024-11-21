<div class="container mt-5">
    <h2>Termékek kezelése</h2>

    <h3 class="mt-5">Létező termékek</h3>
    <div class="table">
        <div class="row">
            <div class="col-md-3">Termék neve</div>
            <div class="col-md-3">Termék ára (HUF)</div>
            <div class="col-md-4">teLeiras</div>
            <div class="col-md-2"><button class="btn btn-primary btn-new " data-bs-toggle='modal'
                    data-bs-target='#ujtermekpopup'>+</button></div>

        </div>
        <?php
        $result = sqlcall("SELECT * FROM termekek");
        while ($row = $result->fetch_assoc()): ?>
        <form action="actions/admin/edit.php" target="kisablak" method="POST">
            <div class="row" id="inputcontainer">
                <input name="tabla" value="termekek" type="hidden" >
                <input name="primary_key" value="teID" type="hidden">
                <input name="id"  value="<?php echo htmlspecialchars($row['teID']); ?>" type="hidden">
                <div class="col-md-3"><input type="text" value="<?php echo $row['teNev']; ?>" name="teNev" class="form-control" readonly></div>
                <div class="col-md-3"><input type="text" value="<?php echo $row['teAr']; ?>" name="teAr" class="form-control" readonly></div>
                <div class="col-md-4"><input type="text" value="<?php echo $row['teLeiras']; ?>" name="teLeiras" class="form-control" readonly></div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                    <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
        <?php endwhile; ?>
    </div>
</div>