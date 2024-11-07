<div class="container mt-5">
    <h2>Kuponok kezelése</h2>
    <h3 class="mt-5">Létező kuponok</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Kod</th>
                <th>Szazalek</th>
                <th>Osszeg</th>
                <th>Alkalmak</th>
                <th>Érvényesség kezdete</th>
                <th>Érvényesség vége</th>
                <th><button class="btn btn-primary">Új</button></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = sqlcall("SELECT * FROM kuponok");
            while ($row = $result->fetch_assoc()): ?>
            <form action="">
                <tr>
                    <td><?php echo $row['kKod']; ?></td>
                    <td><?php echo $row['kSzazalek']; ?></td>
                    <td><?php echo $row['kOsszeg']; ?></td>
                    <td><?php echo $row['kAlkalmak']; ?></td>
                    <td><?php echo $row['kErvenyes_tol']; ?></td>
                    <td><?php echo $row['kErvenyes_ig']; ?></td>
                    <td><button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger">Delete</button></td>

                </tr>
            </form>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>