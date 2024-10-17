<?php 
$contextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);

$context = stream_context_create($contextOptions);
$response = fopen("https://liftzone.hu/api/jegyek/", "r", false, $context);

if ($response === false) {
    echo "Az API-nk jelenleg nem működik.";
} else {
    $json = fread( $response , 8192 ) ;
	fclose( $response ) ;

	$adat = json_decode( $json ) ;

    $jegyek = $adat->data->tipusok;

}
?>

<form action="actions/jegyvasarlas.php" class="form bg-dark text-light p-4 mt-4" method="post" target='kisablak'>
<div class="row">
    <?php
    foreach ($jegyek as $key => $jegy) {
        $card = "
        <div class='col-lg-3 col-md-4 col-sm-5 col-6 d-flex mb-5'>
            <div class='card bg-dark text-white' style='width: 18rem;'>
                <img class='card-img-top' src='...' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>$jegy->tpNev</h5>
                    <p class='card-text'>$jegy->tpAr HUF</p>
                    <a href='#' class='btn btn-primary'>Vásárlás</a> 
                </div>
            </div>
        </div>
        ";
    echo $card;
}
?>
</div>

</form>