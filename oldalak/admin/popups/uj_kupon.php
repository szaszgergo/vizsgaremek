<div class="modal fade" id="ujkuponpopup"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable" >
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Új</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actions/admin/save_kupon.php" method="post" target="kisablak">
                    <div id='error-message' class='alert alert-danger' style='display: none;'></div>
                    <label for="InputNev" class="form-label">Kuponkód</label>
                    <input type="text" id="kKod" name="kKod" maxlength="100" class="form-control bg-secondary text-light" required>
                    
                    <label for="kKod" class="form-label">Százalék</label>
                    <input type="number" id="kSzazalek" name="kSzazalek" maxlength="100" class="form-control bg-secondary text-light">
                    <label for="kSzazalek" class="form-label">Összeg</label>
                    <input type="number" id="kOsszeg" name="kOsszeg" maxlength="100" class="form-control bg-secondary text-light">

                    <label for="kAlkalmak" class="form-label">Hányszor legyen használható? (végtelenhez hagyd üresen)</label>
                    <input type="number" id="kAlkalmak" name="kAlkalmak" maxlength="100" class="form-control bg-secondary text-light">

                    <label for="validFrom" class="form-label">Érvényesség - Kezdő dátum</label>
                    <input type="date" id="validFrom" name="kErvenyes_tol" class="form-control bg-secondary text-light" required>

                    <label for="validTo" class="form-label">Érvényesség - Végdátum</label>
                    <input type="date" id="validTo" name="kErvenyes_ig" class="form-control bg-secondary text-light" required>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Hozzáadás</button>
            </div>
            </form>
        </div>
    </div>
</div>