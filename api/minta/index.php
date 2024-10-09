<?php

    header('Content-Type: application/json; charset=utf-8');

    if( !isset($x) || !isset($y) )
    {
	$tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: x y" ) ;
    }
    else
    {

	$tomb = array(   'x'        => $x ,
	                 'y'        => $y ,

	             ) ;

    }

    $json = json_encode( $tomb , JSON_UNESCAPED_UNICODE ) ;

    print $json ;

?>
