<div class="modal fade" id="ujtermekpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
        <form action="actions/admin/termek_mentes.php" method="post" target="kisablak" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Új termék</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                    
                    <div class="mb-3">
                        <label for="teNev" class="form-label">Termék neve</label>
                        <input type="text" class="form-control" id="teNev" name="teNev" placeholder="Add meg a termék nevét" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="teAr" class="form-label">Termék ára (HUF)</label>
                        <input type="number" class="form-control" id="teAr" name="teAr" placeholder="Add meg a termék árát" min="0" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="teLeiras" class="form-label">Termék leírása</label>
                        <textarea class="form-control" id="teLeiras" name="teLeiras" rows="4" placeholder="Add meg a termék részletes leírását" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="teKepek" class="form-label">Képek feltöltése</label>
                        <input type="file" class="form-control" id="teKepek" required name="teKepek[]" multiple accept="image/*">
                        <div class="form-text">Tölts fel egy vagy több képet a termékről (JPEG, PNG, stb.).</div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Hozzáadás</button>
            </div>
            </form>
        </div>
    </div>
</div>
