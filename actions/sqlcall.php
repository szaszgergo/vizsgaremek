<?php
function db_connect() {
    $fajlnev = dirname(__DIR__) . '/.env';
    $config = [];
    if (file_exists($fajlnev)) {
        $lines = file($fajlnev, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode('=', $line, 2);
            $config[trim($key)] = trim($value);
        }
    } else {
        die("A .env fájl hiányzik");
    }
    $db_host = $config['DB_HOST'] ?? 'localhost';
    $db_user = $config['DB_USER'] ?? 'root';
    $db_pass = $config['DB_PASS'] ?? '';
    $db_name = $config['DB_NAME'] ?? 'default_db'; 
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $db->query("SET CHARACTER SET utf8");
    return $db;
}

// Paraméterezett SQL lekérdezés (SELECT típusú)
function sqlcall($sql, $types = '', $params = []) {
    $db = db_connect();
    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        die("SQL hiba: " . $db->error);
    }
    
    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $db->close();
    return $result;
}

// Paraméterezett SQL lekérdezés (INSERT, UPDATE, DELETE típusú)
function sqlsave($sql, $types = '', $params = []) {
    $db = db_connect();
    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        die("SQL hiba: " . $db->error);
    }
    
    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    if ($stmt->execute() !== true) {
        echo "Hiba: " . $stmt->error;
    }
    
    $stmt->close();
    $db->close();
}
// Ezek a paraméterezett SQL lekérdezéshez kellettek, amit a query függvény nem kezel helyesen.
?>



<?php
/*
function db_connect() {
    $fajlnev = dirname(__DIR__) . '/.env';
    $config = [];
    if (file_exists($fajlnev)) {
        $lines = file($fajlnev, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode('=', $line, 2);
            $config[trim($key)] = trim($value);
        }
    } else {
        die("A .env fájl hiányzik");
    }
    $db_host = $config['DB_HOST'] ?? 'localhost';
    $db_user = $config['DB_USER'] ?? 'root';
    $db_pass = $config['DB_PASS'] ?? '';
    $db_name = $config['DB_NAME'] ?? 'default_db'; 
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
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
*/
?>