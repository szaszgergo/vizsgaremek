<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("
    SELECT edzok_kommentek.ekID, 
    edzok_kommentek.ekKomment, edzok_kommentek.ekDatum, user.uemail
    FROM edzok_kommentek
    INNER JOIN user ON edzok_kommentek.ekUserID = user.uID
");

$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$oldalak = sqlcall("
    SELECT edzok_kommentek.ekID, edzok_kommentek.ekKomment, edzok_kommentek.ekDatum, user.uemail
    FROM edzok_kommentek
    INNER JOIN user ON edzok_kommentek.ekUserID = user.uID
    LIMIT $start, $rows_per_page
");
?>

<div id="all-comments">
    <?php while ($row = $oldalak->fetch_assoc()): ?>
        <div class="comment">
            <div class="table row">
                <div class="col-md-10">
                    <p><strong>Email:</strong> <?php echo $row['uemail']; ?></p>
                    <p><strong>Komment:</strong> <?php echo $row['ekKomment']; ?></p>
                    <p><small><em>Dátum: <?php echo $row['ekDatum']; ?></em></small></p>
                </div>
                <div class="col-md-1">
                    <form method="post" action="actions/velemeny_feldolgozas.php" target="kisablak">
                        <input type="hidden" name="ekID" value="<?php echo $row['ekID']; ?>">
                        <input type="hidden" name="accept" value="elfogadas">
                        <button type="submit" class="btn btn-success">✔</button>
                    </form>
                </div>
                <div class="col-md-1">
                    <form method="post" action="actions/velemeny_feldolgozas.php" target="kisablak">
                        <input type="hidden" name="ekID" value="<?php echo $row['ekID']; ?>">
                        <input type="hidden" name="deny" value="elutasitas">
                        <button type="submit" class="btn btn-danger">✖</button>
                    </form>
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

<div class="pagination" style="display: flex; justify-content: center;align-items: center;">
    <a href="?o=admin&a=velemenyek&page-nr=1" class="pagination-btn">First</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=admin&a=velemenyek&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Previous</a>
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
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=admin&a=velemenyek&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=admin&a=velemenyek&page-nr=2" class="pagination-btn">Next</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Next</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=admin&a=velemenyek&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Next</a>
    <?php
        }
    }
    ?>

    <a href="?o=admin&a=velemenyek&page-nr=<?php echo $pages; ?>" class="pagination-btn">Last</a>
</div>