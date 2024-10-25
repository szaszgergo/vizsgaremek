<div class="modal fade" id="staticBackdrop"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-scrollable" >
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Kosár</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form action="./actions/jegyvasarlas.php" target="kisablak" method="post"> -->
            <div class="modal-body">
                <table class="kosartable">
                    <tr>
                        <td id="jegynev"></td>
                        <td>1</td>
                        <td class="price" id="jegyar"></td>
                    </tr>
                    <tr>
                        <td>HELL</td>
                        <td>2</td>
                        <td class="price">600 HUF</td>
                    </tr>
                    <tr>
                        <td>Proteinszelet</td>
                        <td>2</td>
                        <td class="price">1234 HUF</td>
                    </tr>
                </table>
                <div class="row">
                <label for="InputCim" class="form-label">Kuponkód</label>
                <div class="col-7"><input type="text" id="InputKupon" name="InputKupon" maxlength="100" class="form-control bg-secondary text-light"></div>
                <div class="col-5"><button class="btn btn-primary">Kód alkalmazása</button></div>
                </div>

                <hr>
                <div id="osszar" class="m-1 text-right"></div>
                <input type="hidden" id="ftpID" name='ftpID' readonly>
                <label for="InputNev" class="form-label">Név</label>
                <input type="text" id="InputNev" name="InputNev" maxlength="100" class="form-control bg-secondary text-light" required>
                <label for="InputEmail" class="form-label">Email</label>
                <input type="text" id="InputEmail" name="InputEmail" maxlength="100" class="form-control bg-secondary text-light" required>
                <label for="InputAdo" class="form-label">Adószám</label>
                <input type="text" id="InputAdo" name="InputAdo" maxlength="100" class="form-control bg-secondary text-light" required>
                <label for="InputCim" class="form-label">Lakcím</label>
                <input type="text" id="InputCim" name="InputCim" maxlength="100" class="form-control bg-secondary text-light" required>
                <input type="checkbox" name="check" required>
                <label for="check">Elfogadom az általános szerződési feltételeket</label>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" class="btn btn-primary">Tovább a fizetésre</button> -->
                <button class="btn btn-primary" data-bs-target="#kartyainfo" data-bs-toggle="modal">Tovább a fizetésre</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>