<div class="modal fade" id="kartyainfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Fizetési Információ                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Payment Form -->
            <form action="./actions/jegyvasarlas.php" target="kisablak" method="post">
                <div class="modal-body">
                    <div class="row">

                    </div>
                    <div class="text bg-dark p-3">
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-amazon-pay" style="color:navy; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-amex" style="color:blue; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-mastercard" style="color:red; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-discover" style="color:orange; font-size: 24pt;"></i></a> 
                    </div>
                    <input type="hidden" id="ftpIDvegleges" name="ftpIDvegleges">
                    <label for="cardNumber" class="form-label">Kártyaszám</label>
                    <input type="text" id="cardNumber" name="cardNumber" maxlength="16" class="form-control bg-secondary text-light mb-3" required pattern="\d{16}" title="Enter a 16-digit card number">
                    
                    <label for="cardExpiry" class="form-label">Lejárat dátuma</label>
                    <input type="text" id="cardExpiry" name="cardExpiry" maxlength="5" class="form-control bg-secondary text-light mb-3" placeholder="MM/YY" required pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" title="Enter in MM/YY format">
                    
                    <label for="cardCVC" class="form-label">CVC</label>
                    <input type="text" id="cardCVC" name="cardCVC" maxlength="3" class="form-control bg-secondary text-light mb-3" required pattern="\d{3}" title="Enter a 3-digit CVC">

                    <input type="checkbox" id="termsCheck" name="termsCheck" required>
                    <label for="termsCheck" class="form-label ms-1">Elfogadom az általános szerződési feltételeket</label>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Vásárlás</button>
                </div>
            </form>
        </div>
    </div>
</div>
