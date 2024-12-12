<div class="form-container">
    <form method="post" action="actions/uzenofalFeldolgozas.php" target="kisablak" enctype="multipart/form-data">
        <div id='error-message' class='alert alert-danger' style='display: none;'></div>
        <div id="success-message" class="mt-3 p-1" style="display: none; width:88%; background-color:#28a745; color: #fff; border-radius: 5px; margin: auto;"></div>
        <label for="title">Cím:</label> <br>
        <textarea id="title" class="form-textarea" name="cim" required></textarea> <br><br>
        <label for="content">Szöveg:</label> <br>
        <textarea id="content" class="form-textarea" name="szoveg" required></textarea> <br><br>
        <input type="file" class="form-file" name="kep"> <br><br>
        <button type="submit" class="form-button" name="kozzetetel">Közzététel</button>
    </form>
</div>