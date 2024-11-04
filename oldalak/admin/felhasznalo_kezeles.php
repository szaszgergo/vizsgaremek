<div class="container mt-5">
    <h2>Felhasználók kezelése</h2>

    <h3 class="mt-5">Létező felhasználók</h3>
    <table class="table">
        <thead>
            <tr>
                <th>UID</th>
                <th>Felhasználónév</th>
                <th>Profilkép</th>
                <th>email</th>
                <th>Szerep</th>
                <th>Komment</th>
                <th><button class="btn btn-primary">Új</button></th>

            </tr>
        </thead>
        <tbody>
            <?php
            $result = sqlcall("SELECT * FROM user");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['uUID']; ?></td>
                    <td><?php echo $row['uFelhasznalonev']; ?></td>
                    <td><img alt="Profile Image" class="profile-image" src="profile_pic/<?= empty($row['uProfilePic']) ? '../images/pic.png' : $row['uProfilePic'] ?>"/></td>
                    <td><?php echo $row['uemail']; ?></td>
                    <td><?php echo $row['uStatus']; ?></td>
                    <td><?php echo $row['uKomment']; ?></td>
                    <td><button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger">Delete</button></td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>