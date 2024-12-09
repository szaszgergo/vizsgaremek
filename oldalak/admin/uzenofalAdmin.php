<div class="form-container">
    <form method="post" action="actions/uzenofalFeldolgozas.php" target="kisablak" enctype="multipart/form-data">
        <label for="title">Cím:</label> <br>
        <textarea id="title" class="form-textarea" name="cim" required></textarea> <br>
        <label for="content">Szöveg:</label> <br>
        <textarea id="content" class="form-textarea" name="szoveg" required></textarea> <br>
        <input type="file" class="form-file" name="kep"> <br>
        <button type="submit" class="form-button" name="kozzetetel">Közzététel</button>
    </form>
</div>