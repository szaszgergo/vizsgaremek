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
    Showing <?php echo $page; ?> of <?php echo $pages; ?> pages
</div>

<div class="pagination" style="display: flex; justify-content: center; align-items: center;">
    <a href="?o=admin&a=messages&page-nr=1" class="pagination-btn">First</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=messages&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Previous</a>
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
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=messages&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=messages&page-nr=2" class="pagination-btn">Next</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Next</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=messages&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Next</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=messages&page-nr=<?php echo $pages; ?>" class="pagination-btn">Last</a>
</div>