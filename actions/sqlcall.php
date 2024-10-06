<?php
function db_connect() {
    $db = new mysqli("localhost", "root", "", "regisztraciofitness");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $db->query("SET CHARACTER SET utf8");
    return $db;
}

function sqlcall($sql) {
    $db = db_connect();
    $result = $db->query($sql);
    $db->close();
    return $result;
}

function sqlsave($sql) {
    $db = db_connect();
    if ($db->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    $db->close();
}
?>