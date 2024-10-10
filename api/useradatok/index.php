<?php
    header('Content-Type: application/json; charset=utf-8');
    include("../../actions/sqlcall.php");
    function getJegyTipusAdatok($tipus){
        $sql = "SELECT * FROM tipusok WHERE tpID = $tipus";
        $sor = sqlcall($sql)->fetch_assoc();
        return $sor;
    }


    if( !isset($_GET["uid"]))
    {
	    $tomb = array(  'status'    => 400 ,
                        'hiba'      => "hiányos adatok" ,
                        'uzenet'    => "megadandó paraméterek: uid" ) ;
    }
    else
    {
        $userlekerdezes = "SELECT * FROM user WHERE uID = '$_GET[uid]'";
        $user = sqlcall($userlekerdezes);
        $useradatok = $user->fetch_assoc();
        if (!isset($useradatok)) {
            $tomb = array(  'status'    => 404  ,
                            'hiba'      => "nincs találat" ,
                            'uzenet'    => "megadott paraméter nem helyes, nem létezik" ) ;
            }
            else{
                $jegyeklekerdezes = "SELECT * FROM jegyek WHERE juID = '$_GET[uid]'";
                $jegyek = sqlcall($jegyeklekerdezes);
                $jegyekarray = [];
                while ($row = $jegyek->fetch_assoc()) {
                    $jegyekarray[] = $row;
                }
                if (sizeof($jegyekarray)) {       
                    //hozzaadjuk a jegyekhez a nevet is
                    foreach ($jegyekarray as $key => $value) {
                        $jegyekarray[$key]["jNev"] = getJegyTipusAdatok($value['jtID'])['tpNev']; 
                    }
                }

                $tomb = array(
                                'status'        => 200 ,
                                'adatok'        => $useradatok ,
                                'jegyek'        => $jegyekarray ,
                            ) ;

                }
        }
        $json = json_encode( $tomb , JSON_UNESCAPED_UNICODE ) ;

        print $json ;

?>
