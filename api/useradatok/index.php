<?php
    //userinfo
    header('Content-Type: application/json; charset=utf-8');

    if( !isset($_GET["uid"]))
    {
	    $tomb = array( 'hiba' => "hiányos adatok" ,  'uzenet' => "megadandó paraméterek: uid" ) ;
    }
    else
    {

        include("../../actions/sqlcall.php");
        $userlekerdezes = "SELECT * FROM user WHERE uID = '$_GET[uid]'";
        $user = sqlcall($userlekerdezes);
        $useradatok = $user->fetch_assoc();

        $jegyeklekerdezes = "SELECT * FROM jegyek WHERE juID = '$_GET[uid]'";
        $jegyek = sqlcall($jegyeklekerdezes);
        $jegyekarray = [];

        while ($row = $jegyek->fetch_assoc()) {
            $jegyekarray[] = $row;
        }
    


	$tomb = array(   'adatok'        => $useradatok ,
	                 'jegyek'        => $jegyekarray ,
	             ) ;

    }

    $json = json_encode( $tomb , JSON_UNESCAPED_UNICODE ) ;

    print $json ;

?>
