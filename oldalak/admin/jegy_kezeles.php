<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("SELECT * FROM tipusok");

$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$oldalak = sqlcall("SELECT * FROM tipusok LIMIT $start, $rows_per_page");
?>

<div class="container mt-5">
    <h2>Jegyek kezelése</h2>

    <h3 class="mt-5">Létező jegyek</h3>
    <div id='error-message' class='alert alert-danger' style='display: none;'></div>

    <div class="table">
            <div class="row">
                <div class="col-md-4">Név</div>
                <div class="col-md-2">Ár</div>
                <div class="col-md-2">Hossz</div>
                <div class="col-md-2">Alkalmak</div>
                <div class="col-md-2"><button class="btn btn-primary btn-new">+</button></div>

            </div>

            <?php
            while ($row = $oldalak->fetch_assoc()): ?>
                <div class="row" id="inputcontainer">
                    <form action="actions/admin/edit.php" target="kisablak" method="post" class="row">
                        <input name="tabla" value="tipusok" type="hidden" >
                        <input name="primary_key" value="tpID" type="hidden">
                        <input name="id"  value="<?php echo htmlspecialchars($row['tpID']); ?>" type="hidden">
                        <div class="col-md-4"><input type="text" value="<?php echo $row['tpNev']; ?>" name="tpNev" class="form-control" readonly></div>
                        <div class="col-md-2"><input type="number" value="<?php echo $row['tpAr']; ?>" name="tpAr" class="form-control" readonly></div>
                        <div class="col-md-2"><input type="number" value="<?php echo $row['tpHossz']; ?>" name="tpHossz" class="form-control" readonly></div>
                        <div class="col-md-1"><input type="number" value="<?php echo $row['tpAlkalmak']; ?>" name="tpAlkalmak" class="form-control" readonly></div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-warning" id="edit-btn">Szerkesztés</button>
                            <button type="submit" class="btn btn-success" id="btn-save">Mentés</button>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger">Törlés</button>
                        </div>
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
    Megjelenítve <b style="font-size: 1.2rem;"><?php echo $page; ?></b> a/az <b style="font-size: 1.2rem;"><?php echo $pages; ?></b> oldal közül
</div>

<div class="pagination" style="display: flex; justify-content: center;align-items: center;">
    <a href="?o=admin&a=jegy_kezeles&page-nr=1" class="pagination-btn">Első</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=jegy_kezeles&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Előző</a>
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
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=jegy_kezeles&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=jegy_kezeles&page-nr=2" class="pagination-btn">Következő</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Következő</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=jegy_kezeles&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Következő</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=jegy_kezeles&page-nr=<?php echo $pages; ?>" class="pagination-btn">Utolsó</a>
</div>