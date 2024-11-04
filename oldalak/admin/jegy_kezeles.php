<div class="container mt-5">
    <h2>Jegyek kezelése</h2>

    <h3 class="mt-5">Létező jegyek</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Ár</th>
                <th>Hossz</th>
                <th>Alkalmak</th>
                <th><button class="btn btn-primary">Új</button></th>

            </tr>
        </thead>
        <tbody>
            <?php
            $result = sqlcall("SELECT * FROM tipusok");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['tpNev']; ?></td>
                    <td><?php echo $row['tpAr']; ?></td>
                    <td><?php echo $row['tpHossz']; ?></td>
                    <td><?php echo $row['tpAlkalmak']; ?></td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>