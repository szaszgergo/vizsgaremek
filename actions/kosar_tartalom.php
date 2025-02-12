<?php 

function getKosarContent(){
$uid = $_SESSION["uid"]; 
$kosarlekeres = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL");
$kosar = $kosarlekeres->fetch_assoc();
$kosarid = $kosar["koID"];

if (!$kosarid) {
    sqlcall("INSERT INTO kosar (koUID) VALUES ($uid)");
    $kosarid = sqlcall("SELECT koID FROM kosar WHERE koUID = $uid AND koTranzakcioID IS NULL")->fetch_assoc()["koID"];
}

$kosartartalomlekeres = sqlcall("SELECT * FROM kosar_tetelek WHERE ktkoID = $kosarid AND ktStatus = 1");
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
