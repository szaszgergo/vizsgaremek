<?php
    require('../sqlcall.php');
    function dinamikusSQLGenerátor_inátor($tabla, $adatok, $primaryKey, $id) {
        $tabla = preg_replace('/[^a-zA-Z0-9_]/', '', $tabla);
        $setParts = [];
        foreach ($adatok as $field => $value) {
            $field = preg_replace('/[^a-zA-Z0-9_]/', '', $field);
            $escapedValue = addslashes($value);
            $setParts[] = "$field = '$escapedValue'";
        }
        
        $setQuery = implode(", ", $setParts);
        $sql = "UPDATE $tabla SET $setQuery WHERE $primaryKey = $id";
        return $sql;
    }
    $tabla = $_POST['tabla'];
    $primaryKey = $_POST['primary_key'];
    $id = intval($_POST['id']);
    
    $adatok = $_POST;
    unset($adatok['tabla'], $adatok['primary_key'], $adatok['id'], $adatok['status']);
    
    $sql = dinamikusSQLGenerátor_inátor($tabla, $adatok, $primaryKey, $id);
    sqlsave($sql);
    echo "<script>if(window.parent){window.parent.location.reload();}</script>";
?>