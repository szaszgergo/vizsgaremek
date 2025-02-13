<?php
    require('../sqlcall.php');
    
    function dinamikusSQLGenerátor_inátor_csak_torleshez($tabla, $primaryKey, $id, $statusField) {
        $tabla = preg_replace('/[^a-zA-Z0-9_]/', '', $tabla);
        $primaryKey = preg_replace('/[^a-zA-Z0-9_]/', '', $primaryKey);
        $statusField = preg_replace('/[^a-zA-Z0-9_]/', '', $statusField);
        
        $id = intval($id);
        
        $sql = "UPDATE $tabla SET $statusField = 0 WHERE $primaryKey = $id";
        return $sql;
    }
    
    $tabla = $_POST['tabla'];
    $primaryKey = $_POST['primary_key'];
    $id = intval($_POST['id']);
    $statusField =$_POST['status'] ;
    
    $sql = dinamikusSQLGenerátor_inátor_csak_torleshez($tabla, $primaryKey, $id, $statusField);
    sqlsave($sql);
    
    echo "<script>if(window.parent){window.parent.location.reload();}</script>";
?>