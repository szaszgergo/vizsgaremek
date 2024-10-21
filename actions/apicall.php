<?php


function apicall($url){
    $contextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
    
    $context = stream_context_create($contextOptions);
    $response = @fopen($url, "r", false, $context);
    
    if ($response === false) {
        echo "Az API-nk jelenleg nem működik.";
        return null;
    } else {
        $json = fread( $response , 8192 ) ;
        fclose( $response ) ;
        $adat = json_decode( $json ) ;
        return $adat;
    }
}


?>