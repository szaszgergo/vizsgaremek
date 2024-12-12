<?php
session_start();
// Include the sqlsave function from sqlcall.php
require_once 'sqlcall.php';
$eid=intval($_POST['eid']);
$uid=$_SESSION['uid'];
$currentDateTime='NOW()';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the weekKey and checkbox data from the POST request
    $weekKey = $_POST['weekKey'];
    
    // Loop through the checkboxes and save them
    $totalTime = 0; // A teljes idő összegzése
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'checkbox-') === 0) { // Only process checkbox inputs
            $totalTime += (int)$value; // Az értéket hozzáadjuk
        }
    }

    // Prepare the SQL query to insert or update the data
    $sql = "INSERT INTO edzok_foglalas (foUserID, foEdzoID, foDate, foNap, foIdo)
    VALUES (?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
    foDate = ?, foNap = ?, foIdo = ?";

// Adjust the parameters to match your actual table schema
$params = [$uid, $eid, $currentDateTime, 'Monday', $totalTime, $currentDateTime, 'Monday', $totalTime]; 

// Execute the query with the correct parameter types
sqlsave($sql, 'iiissssi', $params);  // Use 'iiisssss' for 3 integers and 4 strings
//ez még nem jó

    // Respond to the client
    echo "Adatok sikeresen elmentve!";
} else {
    echo "Nem érkezett adat.";
}
?>
