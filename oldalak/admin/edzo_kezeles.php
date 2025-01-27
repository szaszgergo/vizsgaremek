<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("SELECT * FROM user WHERE uSzerep = 3");

$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$oldalak = sqlcall("SELECT * FROM user WHERE uSzerep = 3 LIMIT $start, $rows_per_page");
?>

<div class="container mt-5">
    <h2>Edzők kezelése</h2>

    <h3 class="mt-5">Létező edzők</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="table">
        <div class="row">
            <div class="col-md-2">Státusz</div>
            <div class="col-md-2">Felhasználónév</div>
            <div class="col-md-2">Profilkép</div>
            <div class="col-md-1">email</div>
            <div class="col-md-1">telefonszám</div>
            <div class="col-md-1">Komment</div>
            <div class="col-md-3 text-end">Új hozzáadása: <button class="btn btn-primary btn-new">+</button></div>
        </div>


        <?php
        while ($row = $oldalak->fetch_assoc()):
            $isDeleted = ($row['uStatus'] === 'Deleted');
            $kapcsolas = sqlcall("SELECT * FROM szemelyi_edzok WHERE szeUID = $row[uID]");
            $adatok = $kapcsolas->fetch_assoc();
        ?>
            <div class="row <?php echo $isDeleted ? 'deleted-row' : ''; ?>" id="inputcontainer">
                <form action="actions/admin/edit.php" target="kisablak" method="post" class="row g-2">
                    <input name="tabla" value="user" type="hidden">
                    <input name="primary_key" type="hidden" value="uID">
                    <input name="id" value="<?php echo htmlspecialchars($row['uID']); ?>" type="hidden">

                    <div class="col-md-2">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($row['uStatus']); ?></span>
                        <?php else: ?>
                            <input type="text" name="uStatus" value="<?php echo htmlspecialchars($row['uStatus']); ?>" readonly class="form-control">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-2">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($row['uFelhasznalonev']); ?></span>
                        <?php else: ?>
                            <input type="text" name="uFelhasznalonev" value="<?php echo htmlspecialchars($row['uFelhasznalonev']); ?>" readonly class="form-control">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-2 position-relative">
                        <?php if (!empty($row['uProfilePic'])): ?>
                            <div class="profile-pic-container">
                                <img alt="Profile Image" class="profile-image img-fluid"
                                    src="profile_pic/<?php echo htmlspecialchars($row['uProfilePic']); ?>">
                                <span class="remove-icon" onclick="removeProfilePicture(<?php echo $row['uID']; ?>)">✕</span>
                            </div>
                        <?php else: ?>
                            <img alt="Profile Image" class="profile-image img-fluid" src="images/pic.png">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-1">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($row['uemail']); ?></span>
                        <?php else: ?>
                            <input type="text" name="uemail" value="<?php echo htmlspecialchars($row['uemail']); ?>" readonly class="form-control">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-1">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($adatok['szeTelefon']); ?></span>
                        <?php else: ?>
                            <input type="text" name="szeTelefon" value="<?php echo htmlspecialchars($adatok['szeTelefon']); ?>" readonly class="form-control">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-2">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($row['uKomment']); ?></span>
                        <?php else: ?>
                            <input type="text" name="uKomment" value="<?php echo htmlspecialchars($row['uKomment']); ?>" readonly class="form-control">
                        <?php endif; ?>
                    </div>

                    <?php if (!$isDeleted): ?>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                            <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" formaction="actions/admin/delete.php" class="btn btn-danger">Edzői jog megvonása</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="page-info" style="text-align: center;">
    <?php
    if (!isset($_GET['page-nr'])) {
        $page = 1;
    } else {
        $page = $_GET['page-nr'];
    }
    ?>
    Showing <?php echo $page; ?> of <?php echo $pages; ?> pages
</div>

<div class="pagination" style="display: flex; justify-content: center;align-items: center;">
    <a href="?o=admin&a=edzo_kezeles&page-nr=1" class="pagination-btn">First</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=edzo_kezeles&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Previous</a>
    <?php
    } else {
    ?>
        <a class="pagination-btn">Previous</a>
    <?php
    }
    ?>

    <div class="page-numbers">
        <?php
        $max_visible_pages = 4;
        $start_page = max(1, $page - 2);
        $end_page = min($pages, $start_page + $max_visible_pages - 1);

        if ($end_page - $start_page + 1 < $max_visible_pages) {
            $start_page = max(1, $end_page - $max_visible_pages + 1);
        }

        for ($counter = $start_page; $counter <= $end_page; $counter++) {
            $activeClass = ($counter == $page) ? 'active' : '';
        ?>
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=edzo_kezeles&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=edzo_kezeles&page-nr=2" class="pagination-btn">Next</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Next</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=edzo_kezeles&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Next</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=edzo_kezeles&page-nr=<?php echo $pages; ?>" class="pagination-btn">Last</a>
</div>

<script>
    function removeProfilePicture(userId) {
        if (confirm("Biztos ki akarod törölni a felhasználó képét?")) {
            fetch('actions/admin/remove_profile_picture.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        userId: userId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Profilkép sikeresen törölve.");
                        location.reload();
                    } else {
                        alert("Sikertelen törlés.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>