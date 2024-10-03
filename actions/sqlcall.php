<?php
function sqlcall($sql) {
    $db = mysqli_connect("localhost","root","","regisztraciofitness");
    $db->query("SET CHARACTER SET utf8");
    $tablazat = $db->query($sql);
    $db->close();
    return $tablazat;
}

function sqlsave($sql) {
    $db = mysqli_connect("localhost","root","","regisztraciofitness");
    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    }
    $db->query("SET CHARACTER SET utf8");
    if ($db->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    $db->close();
}
?>