<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("SELECT * FROM termekek");

$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$oldalak = sqlcall("SELECT * FROM termekek LIMIT $start, $rows_per_page");
?>

<div class="container mt-5">
    <h2>Termékek kezelése</h2>

    <h3 class="mt-5">Létező termékek</h3>
    <div class="table">
        <div class="row">
            <div class="col-md-3">Termék neve</div>
            <div class="col-md-3">Termék ára (HUF)</div>
            <div class="col-md-4">teLeiras</div>
            <div class="col-md-2"><button class="btn btn-primary btn-new " data-bs-toggle='modal'
                    data-bs-target='#ujtermekpopup'>+</button></div>

        </div>
        <?php
        while ($row = $oldalak->fetch_assoc()): ?>
        <form action="actions/admin/edit.php" target="kisablak" method="POST">
            <div class="row" id="inputcontainer">
                <input name="tabla" value="termekek" type="hidden" >
                <input name="primary_key" value="teID" type="hidden">
                <input name="id"  value="<?php echo htmlspecialchars($row['teID']); ?>" type="hidden">
                <div class="col-md-3"><input type="text" value="<?php echo $row['teNev']; ?>" name="teNev" class="form-control" readonly></div>
                <div class="col-md-3"><input type="text" value="<?php echo $row['teAr']; ?>" name="teAr" class="form-control" readonly></div>
                <div class="col-md-4"><input type="text" value="<?php echo $row['teLeiras']; ?>" name="teLeiras" class="form-control" readonly></div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-warning" id="edit-btn">Edit</button>
                    <button type="submit" class="btn btn-success" id="btn-save">Save</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
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
    <a href="?o=admin&a=termek_kezeles&page-nr=1" class="pagination-btn">First</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=termek_kezeles&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Previous</a>
    <?php
    } else {
    ?>
        <a class="pagination-btn">Previous</a>  
    <?php
    }
    ?>

    <div class="page-numbers">
        <?php
        for ($counter = 1; $counter <= $pages; $counter++) {
            $activeClass = ($counter == $page) ? 'active' : '';
        ?>
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=termek_kezeles&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=termek_kezeles&page-nr=2" class="pagination-btn">Next</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Next</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=termek_kezeles&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Next</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=termek_kezeles&page-nr=<?php echo $pages; ?>" class="pagination-btn">Last</a>
</div>