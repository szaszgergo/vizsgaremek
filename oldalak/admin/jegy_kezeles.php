<div class="container mt-5">
    <h2>Jegyek kezelése</h2>

    <h3 class="mt-5">Létező jegyek</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="table">
            <div class="row">
                <div class="col-md-4">Név</div>
                <div class="col-md-2">Ár</div>
                <div class="col-md-2">Hossz</div>
                <div class="col-md-2">Alkalmak</div>
                <div class="col-md-2"><button class="btn btn-primary btn-new">+</button></div>

            </div>

            <?php
            $result = sqlcall("SELECT * FROM tipusok");
            while ($row = $result->fetch_assoc()): ?>
                <div class="row" id="inputcontainer">
                    <form action="actions/admin/edit.php" target="kisablak" method="post" class="row">
                        <input name="tabla" value="tipusok" type="hidden" >
                        <input name="primary_key" value="tpID" type="hidden">
                        <input name="id"  value="<?php echo htmlspecialchars($row['tpID']); ?>" type="hidden">
                        <div class="col-md-4"><input type="text" value="<?php echo $row['tpNev']; ?>" name="tpNev" class="form-control" readonly></div>
                        <div class="col-md-2"><input type="number" value="<?php echo $row['tpAr']; ?>" name="tpAr" class="form-control" readonly></div>
                        <div class="col-md-2"><input type="number" value="<?php echo $row['tpHossz']; ?>" name="tpHossz" class="form-control" readonly></div>
                        <div class="col-md-2"><input type="number" value="<?php echo $row['tpAlkalmak']; ?>" name="tpAlkalmak" class="form-control" readonly></div>
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