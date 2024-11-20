<div class="container mt-5">
    <h2>Termékek kezelése</h2>

    <h3 class="mt-5">Létező termékek</h3>
    <div class="table">
        <div class="row">
            <div class="col-md-1">id</div>
            <div class="col-md-3">Termék neve</div>
            <div class="col-md-3">Termék ára (HUF)</div>
            <div class="col-md-3">teLeiras</div>
            <div class="col-md-2"><button class="btn btn-primary btn-new " data-bs-toggle='modal'
                    data-bs-target='#ujtermekpopup'>+</button></div>

        </div>
        <?php
        $result = sqlcall("SELECT * FROM termekek");
        while ($row = $result->fetch_assoc()): ?>
        <form >
            <div class="row">
                <div class="col-md-1"><?php echo $row['teID']; ?></div>
                <div class="col-md-3"><?php echo $row['teNev']; ?></div>
                <div class="col-md-3"><?php echo $row['teAr']; ?></div>
                <div class="col-md-3"><?php echo $row['teLeiras']; ?></div>
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