<?php 

function getKosarContent($kosarid = null) {
    $uid = $_SESSION["uid"];
    $isActiveCart = false; // Default value to prevent undefined variable warning

    // Try to get an active (not yet purchased) cart
    if (!isset($kosarid)) {
        $kosarlekeres = sqlcall("SELECT koID, koTranzakcioID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL LIMIT 1");
        $kosar = $kosarlekeres->fetch_assoc();
        $kosarid = $kosar["koID"] ?? null;
        $isActiveCart = isset($kosar["koTranzakcioID"]) ? false : true;
    }

    // If no active cart is found, get the most recent purchased cart
    if (!$kosarid) {
        $kosarlekeres = sqlcall("SELECT koID, koTranzakcioID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NOT NULL ORDER BY koTranzakcioID DESC LIMIT 1");
        $kosar = $kosarlekeres->fetch_assoc();
        $kosarid = $kosar["koID"] ?? null;
        $isActiveCart = false; // Purchased cart
    }

    // If still no cart is found, return an empty array
    if (!$kosarid) {
        return [];
    }

    // Build the query dynamically based on whether the cart is active
    $statusCondition = $isActiveCart ? "AND ktStatus = 1" : "";  
    $kosartartalomlekeres = sqlcall("SELECT * FROM kosar_tetelek WHERE ktkoID = $kosarid $statusCondition");
    
    $kosartartalma = [];

    while ($item = $kosartartalomlekeres->fetch_assoc()) {
        $tetelek_tipus = $item['ktTipus'];
        $ktBeazonosito = $item['ktBeazonosito'];

        if ($tetelek_tipus === 'JEGY') {
            $tipusoklekeres = sqlcall("SELECT * FROM tipusok WHERE tpID = $ktBeazonosito");
            $tipusadatok = $tipusoklekeres->fetch_assoc();

            $kosartartalma[] = [
                'type' => 'JEGY',
                'details' => $tipusadatok,
                'count' => $item['ktMennyiseg']
            ];
        } else if ($tetelek_tipus === 'TERMEK') {
            $termeklekeres = sqlcall("SELECT * FROM termekek WHERE teID = $ktBeazonosito");
            $termekadatok = $termeklekeres->fetch_assoc();

            $kosartartalma[] = [
                'type' => 'TERMEK',
                'details' => $termekadatok,
                'count' => $item['ktMennyiseg']
            ];
        }
    }

    return $kosartartalma;
}

?>
