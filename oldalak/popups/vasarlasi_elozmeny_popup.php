<div class="modal fade" id="vasarlasielozmenypopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="kosar">Fizetési Információ </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="./actions/jegy_vasarlas.php" target="kisablak" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col"><strong>Date</strong></div>
                        <div class="col"><strong>Description</strong></div>
                        <div class="col"><strong>Price</strong></div>
                    </div>
                    <?php
                    $uid = $_SESSION["uid"];
                    $felhasznalo_jegyei = sqlcall("SELECT * FROM jegyek WHERE juID = $uid");
                    while ($jegy = $felhasznalo_jegyei->fetch_assoc()):
                        $tpid= $jegy["jtID"];
                        $jegyadatok_lekerdezes = sqlcall("SELECT * FROM tipusok WHERE tpID = $tpid");
                        $jegyadat = $jegyadatok_lekerdezes->fetch_assoc();
                    ?>
                        <div class="row" id="inputcontainer">
                                <div class="col">01/07/2023</div>
                                <div class="col"><?php echo $jegyadat["tpNev"]?></div>
                                <div class="col"><?php echo $jegyadat["tpAr"]?></div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </form>
        </div>
    </div>
</div>