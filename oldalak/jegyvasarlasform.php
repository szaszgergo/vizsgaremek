<?php 


$sql = "SELECT tpID, tpNev FROM tipusok";
$tabla = sqlcall($sql);

?>

<form action="actions/jegyvasarlas.php" class="form bg-dark text-light p-4 mt-4" method="post" target='kisablak'>
    <select class="form-control form-control-dark" name="jtid" id="jtid">
        <?php
        foreach ($tabla as $key => $value) {
            echo "<option value='$value[tpID]'> $value[tpNev]</option>";
        }
        ?>
    </select>
    <br>
    <button type="submit" class="btn btn-warning w-100">Jegy vásárlása</button>
</form>