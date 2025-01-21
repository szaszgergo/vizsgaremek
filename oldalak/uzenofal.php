<?php
$start = 0;

$rows_per_page = 4;

$records = sqlcall("SELECT * FROM uzenofal");
$number_of_rows = $records->num_rows;

$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$adatok = sqlcall("SELECT * FROM uzenofal LIMIT $start, $rows_per_page");
?>

<h1 id="uzenoCim">Üzenőfal</h1>
<br>
<?php while($row = $adatok->fetch_assoc()): ?>
<div class="blokk">
    <h4 class="belsoCim"><strong><?php echo $row["uzenoCim"] ?></strong></h4>
    <p class="belsoSzoveg"><?php echo $row["uzenoSzoveg"] ?></p>
    <p class="belsoDatum"><small><em><?php echo $row["uzenoDatum"] ?></small></em></p>
    <?php if (!empty($row["uzenoKep"])): ?>
        <img src="images/uzenofal/<?php echo str_replace('C:/xampp/htdocs/vizsgaremek/', '', $row["uzenoKep"]); ?>" class="uzenofalKep">
    <?php endif; ?>
</div>
<?php endwhile; ?>

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
    <a href="?o=uzenofal&page-nr=1" class="pagination-btn">First</a>

    <?php
    if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
    ?>
        <a href="?o=uzenofal&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="pagination-btn">Previous</a>
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
            <a class="pagination-btn <?php echo $activeClass; ?>" href="?o=uzenofal&page-nr=<?php echo $counter; ?>"><?php echo $counter; ?></a>
        <?php
        }
        ?>
    </div>

    <?php
    if (!isset($_GET['page-nr'])) {
    ?>
        <a href="?o=uzenofal&page-nr=2" class="pagination-btn">Next</a>
        <?php
    } else {
        if ($_GET['page-nr'] >= $pages) {
        ?>
            <a class="pagination-btn">Next</a>
        <?php
        } else {
        ?>
            <a class="pagination-btn" href="?o=uzenofal&page-nr=<?php echo $_GET['page-nr'] + 1; ?>">Next</a>
    <?php
        }
    }
    ?>

    <a href="?o=uzenofal&page-nr=<?php echo $pages; ?>" class="pagination-btn">Last</a>
</div>