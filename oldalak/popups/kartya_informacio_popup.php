<div class="modal fade" id="kartyainfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Fizetési Információ                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="./actions/jegy_vasarlas.php" target="kisablak" method="post">
                <div class="modal-body">
                    <div class="text bg-dark p-3">
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-visa" style="color: #1A1F71; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-paypal" style="color: #003087; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-mastercard" style="background-image: linear-gradient(to right, #FF5F00 50%, #F79E1B 50%);-webkit-background-clip: text; color: transparent; font-size: 24pt;"></i></a>
                        <a class="m-1" href="#"><i class="fa-brands fa-cc-stripe" style="color: #635bff; font-size: 24pt;"></i></a> 
                    </div>
                    <input type="hidden" id="ftpIDvegleges" name="ftpIDvegleges">
                    <label for="cardNumber" class="form-label">Kártyaszám</label>
                    <input type="text" id="cardNumber" name="cardNumber" maxlength="19" class="form-control bg-secondary text-light mb-3" required pattern="(?:\d{4}-){3}\d{4}|\d{16}" title="Adj meg egy 16-számjegyű kártya számot">
                    
                    <div class="row">
                        <div class="col-6">
                            <label for="cardExpiryMonth" class="form-label">Lejárat hónapja</label>
                            <input type="text" id="cardExpiryMonth" name="cardExpiryMonth" maxlength="2" class="form-control bg-secondary text-light mb-3" placeholder="HH" required pattern="(?:0[1-9]|1[0-2])" title="Add meg a lejárati hónapot (01-12)">
                        </div>
                        <div class="col-6">
                            <label for="cardExpiryYear" class="form-label">Lejárat éve</label>
                            <input type="text" id="cardExpiryYear" name="cardExpiryYear" maxlength="2" class="form-control bg-secondary text-light mb-3" placeholder="ÉÉ" required pattern="[0-9]{2}" title="Add meg a lejárati év utolsó két számjegyét">
                        </div>
                    </div>
                    
                    <label for="cardCVC" class="form-label">CVC</label>
                    <input type="text" id="cardCVC" name="cardCVC" maxlength="3" class="form-control bg-secondary text-light mb-3" required pattern="\d{3}" title="Add meg a 3 számjegyű CVC-t">

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
