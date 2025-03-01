<div class="container mt-5">
    <h2>Felhasználók kezelése</h2>

    <h3 class="mt-5">Létező felhasználók</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <?php
    $start = 0;

    $rows_per_page = 4;

    $records = sqlcall("SELECT * FROM user WHERE uSzerep = 1");

    $number_of_rows = $records->num_rows;

    $pages = ceil($number_of_rows / $rows_per_page);

    if (isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rows_per_page;
    }

    $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
    $sql = "SELECT * FROM user WHERE uSzerep = 1 LIMIT $start, $rows_per_page";

    if ($searchQuery !== '') {
        $maxlimit = $start + $rows_per_page;
        $sql = "SELECT * FROM user WHERE uSzerep = 1 AND (uFelhasznalonev LIKE '%$searchQuery%')";
        $result = sqlcall($sql);
        $number_of_rows = $result->num_rows;
        if ($number_of_rows > 3) {
            $pages = ceil($number_of_rows / $rows_per_page);
            $sql = "SELECT * FROM user WHERE uSzerep = 1 AND (uFelhasznalonev LIKE '%$searchQuery%') LIMIT $start, $maxlimit";
            $result = sqlcall($sql);
        } else {
            $sql = "SELECT * FROM user WHERE uSzerep = 1 AND (uFelhasznalonev LIKE '%$searchQuery%') LIMIT $start, $maxlimit";
            $result = sqlcall($sql);
            $pages = ceil($number_of_rows / $rows_per_page);
        }
    }   
    $result = sqlcall($sql);
    ?>

    <div class="table">
        <form method="get" action="">
            <div class="row mb-3">
                <div class="col-md-11">
                    <input type="hidden" name="o" value="admin">
                    <input type="hidden" name="a" value="felhasznalo_kezeles">

                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Keresés név alapján" value="<?php echo htmlspecialchars($searchQuery); ?>">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Keresés</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-2">Státusz</div>
            <div class="col-md-2">Felhasználónév</div>
            <div class="col-md-2">Profilkép</div>
            <div class="col-md-2">email</div>
            <div class="col-md-2">Komment</div>
        </div>

        <?php
        while ($row = $result->fetch_assoc()):
            $isDeleted = ($row['uStatus'] === 'Deleted'); ?>
            <div class="row <?php echo $isDeleted ? 'deleted-row' : ''; ?>" id="inputcontainer">
                <form action="actions/admin/edit.php" target="kisablak" method="post" class="row g-2">
                    <input name="tabla" value="user" type="hidden">
                    <input name="primary_key" type="hidden" value="uID">
                    <input name="id" value="<?php echo htmlspecialchars($row['uID']); ?>" type="hidden">

                    <div class="col-md-1">
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
                                <img alt="Profile Image" class="profile-image img-fluid" src="profile_pic/<?php echo htmlspecialchars($row['uProfilePic']); ?>">
                                <span class="remove-icon" onclick="removeProfilePicture(<?php echo $row['uID']; ?>)">✕</span>
                            </div>
                        <?php else: ?>
                            <img alt="Profile Image" class="profile-image img-fluid" src="images/pic.png">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-2">
                        <?php if ($isDeleted): ?>
                            <span><?php echo htmlspecialchars($row['uemail']); ?></span>
                        <?php else: ?>
                            <input type="text" name="uemail" value="<?php echo htmlspecialchars($row['uemail']); ?>" readonly class="form-control">
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
                        <div class="col-md-2">
                            <button type="button" class="btn btn-warning" id="edit-btn">Szerkesztés</button>
                            <button type="submit" class="btn btn-success" id="btn-save">Mentés</button>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" formaction="actions/admin/delete.php" class="btn btn-danger">Törlés</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="page-info" style="text-align: center;">
        <?php
        if (!isset($_GET['page-nr'])) {
            $page = 1;
        } else {
            $page = $_GET['page-nr'];
        }
        ?>
        Megjelenítve <b style="font-size: 1.2rem;"><?php echo $page; ?></b> a/az <b style="font-size: 1.2rem;"><?php echo $pages; ?></b> oldal közül
    </div>

    <div class="pagination" style="display: flex; justify-content: center;align-items: center;">
        <a href="?o=admin&a=felhasznalo_kezeles&page-nr=1&search=<?php echo $_GET['search']; ?>" class="pagination-btn">Első</a>

        <?php
        if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
        ?>
            <a href="?o=admin&a=felhasznalo_kezeles&page-nr=<?php echo $_GET['page-nr'] - 1; ?>&search=<?php echo $_GET['search'] ?>" class="pagination-btn">Előző</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn">Előző</a>
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
                <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=felhasznalo_kezeles&page-nr=<?php echo $counter; ?>&search=<?php echo $_GET['search']; ?>"><?php echo $counter; ?></a>
            <?php
            }
            ?>
        </div>


        <?php
        if (!isset($_GET['page-nr'])) {
        ?>
            <a href="?o=admin&a=felhasznalo_kezeles&page-nr=2&search=<?php echo $_GET['search']; ?>" class="pagination-btn">Következő</a>
            <?php
        } else {
            if ($_GET['page-nr'] >= $pages) {
            ?>
                <a class="pagination-btn">Következő</a>
            <?php
            } else {
            ?>
                <a class="pagination-btn" href="?o=admin&a=felhasznalo_kezeles&page-nr=<?php echo $_GET['page-nr'] + 1; ?>&search=<?php echo $_GET['search']; ?>">Következő</a>
        <?php
            }
        }
        ?>

        <a href="?o=admin&a=felhasznalo_kezeles&page-nr=<?php echo $pages; ?>&search=<?php echo $_GET['search']; ?>" class="pagination-btn">Utolsó</a>
    </div>

    <h3 class="mt-5">Admin felhasználók</h3>
    <div class="table">
        <div class="row">
            <div class="col-md-2">Státusz</div>
            <div class="col-md-2">Felhasználónév</div>
            <div class="col-md-2">Profilkép</div>
            <div class="col-md-2">email</div>
            <div class="col-md-3 text-end">Új hozzáadása: <button class="btn btn-primary btn-new">+</button></div>
        </div>

        <?php
        $result = sqlcall("SELECT * FROM user WHERE uSzerep = 2");
        while ($row = $result->fetch_assoc()):
            $isDeleted = ($row['uStatus'] === 'Deleted'); ?>
            <div class="row <?php echo $isDeleted ? 'deleted-row' : ''; ?>" id="inputcontainer">
                <form action="actions/admin/delete.php" target="kisablak" method="post" class="row g-2">
                    <div class="col-md-2">
                        <span><?php echo htmlspecialchars($row['uStatus']); ?></span>
                    </div>

                    <div class="col-md-2">
                        <span><?php echo htmlspecialchars($row['uFelhasznalonev']); ?></span>
                    </div>

                    <div class="col-md-2 position-relative">
                        <?php if (!empty($row['uProfilePic'])): ?>
                            <div class="profile-pic-container">
                                <img alt="Profile Image" class="profile-image img-fluid"
                                    src="profile_pic/<?php echo htmlspecialchars($row['uProfilePic']); ?>">
                            </div>
                        <?php else: ?>
                            <img alt="Profile Image" class="profile-image img-fluid" src="images/pic.png">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-2">
                        <span><?php echo htmlspecialchars($row['uemail']); ?></span>
                    </div>

                    <?php if (!$isDeleted): ?>
                        <div class="col-md-1">
                            <input value="<?php echo htmlspecialchars($row['uID']); ?>" name="uid" type="hidden">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
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