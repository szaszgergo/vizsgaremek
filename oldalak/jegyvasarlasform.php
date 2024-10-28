<?php 
$response = apicall('http://liftzone.hu/api/jegyek/');
if ($response && isset($response->data->tipusok)) {
    $jegyek = $response->data->tipusok;
} else {
    echo "Nem sikerült lekérni a jegyeket, vagy hibás az API válasz.";
}
?>
<div style="text-align: center; margin: 5 auto;" class="container jegyform p-4">
    <div class="row">
        <?php
        foreach ($jegyek as $key => $jegy) {
            $card = "
            <div class='col-lg-4 col-md-6 col-sm-12  mb-5'>
                <div class='card text-white'>
                    <div class='card-body'>
                        <h4 class='card-title text-start'>$jegy->tpNev</h4>
                        <p class='card-text text-start'>$jegy->tpAr HUF</p>
                        <input style='display: none;' type='text' name='tpID' value='$jegy->tpID' readonly>
                        <button type='submit' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Vásárlás</button>
                    </div>
                </div>
            </div>
            ";
        echo $card;
    }
    ?>
    </div>
</div>
