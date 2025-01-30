<?php
require("../sqlcall.php");

$searchQuery = isset($_GET['searchUser']) ? trim($_GET['searchUser']) : '';

if ($searchQuery === '') {
    echo "<div class='alert alert-warning'>Kérlek, adj meg egy keresési kifejezést.</div>";
    exit;
}

$sql = "SELECT * FROM `user` WHERE uSzerep != 3 AND uFelhasznalonev LIKE '%$searchQuery%'";
$users = sqlcall($sql);

if ($users->num_rows > 0) {
    echo "<div class='table'>
            <div class='row'>
                <div class='col-md-6'>Név</div>
                <div class='col-md-6'>Felhasználónév</div>
            </div>";

    foreach ($users as $user) {
        echo "<div class='row mb-2'>
                <form action='./actions/admin/add.php' method='post' class='row' target='kisablak'>
                    <input type='hidden' value='$user[uID]' name='uID'>
                    <div class='col-md-4'>" . htmlspecialchars($user['uSzuleteskorinev']) . "</div>
                    <div class='col-md-4'>" . htmlspecialchars($user['uFelhasznalonev']) . "</div>
                    <div class='col-md-4'>
                        <button style='background-color: #0d6efd;' class='btn btn-primary' type='submit'>Add as Trainer</button>
                    </div>
                </form>
              </div>";
    }
    echo "</div>";
} else {
    echo "<div class='alert alert-info'>Nincs találat a(z) '" . htmlspecialchars($searchQuery) . "' keresésre.</div>";
}
?>