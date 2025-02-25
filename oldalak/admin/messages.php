<div class="row">
    <div class="col-md-6">
        <h3>Email</h3>
    </div>
    <div class="col-md-6">
        <h3>Üzenet</h3>
    </div>
</div>

<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("SELECT * FROM messages");
$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$oldalak = sqlcall("SELECT * FROM messages LIMIT $start, $rows_per_page");
?>

<div id="all-messages">
    <?php while ($row = $oldalak->fetch_assoc()): ?>
        <div class="message">
            <div class="table row">
                <div class="col-md-3">
                    <p><?php echo $row['mEmail']; ?></p>
                </div>
                <div class="col-md-9">
                    <p><?php echo $row['mUzenet']; ?></p>
                </div>
            </div>
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

<div class="pagination" style="display: flex; justify-content: center; align-items: center;">
    <a href="?o=admin&a=messages&page-nr=1" class="pagination-btn">Első</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=messages&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Előző</a>
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
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=messages&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=messages&page-nr=2" class="pagination-btn">Következő</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Következő</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=messages&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Következő</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=messages&page-nr=<?php echo $pages; ?>" class="pagination-btn">Utolsó</a>
</div>