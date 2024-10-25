<?php 
$response = apicall('https://liftzone.hu/api/jegyek/');
if ($response && isset($response->data->tipusok)) {
    $jegyek = $response->data->tipusok;
} else {
    echo "Nem sikerült lekérni a jegyeket, vagy hibás az API válasz.";
}
?>
<div style="text-align: center; margin: 5 auto;" class="container bg-dark p-4">
    <div class="row">
        <?php
        foreach ($jegyek as $key => $jegy) {
            $card = "
            <div class='col-lg-3 col-md-4 col-sm-5 col-6 mb-5'>
                <div class='card bg-dark text-white' style='width: 18rem;'>
                    <img class='card-img-top' src='./images/bg.jpg' alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'>$jegy->tpNev</h5>
                        <p class='card-text'>$jegy->tpAr HUF</p>
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
