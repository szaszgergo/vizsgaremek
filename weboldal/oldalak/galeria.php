<div class="gallery">
    <?php
        $mappanev = "images/galeria/" ;

        $mappa = opendir($mappanev);
        while ($fajl = readdir($mappa)) {
            $t = strtolower(substr($fajl, -4));

            if ($t == ".jpg" || $t == "jpeg" || $t == ".png" || $t == ".gif") {
                print "
                    <div class='gallery-item'>
                        <figure>
                            <a target='_' href='$mappanev/$fajl'><img src='$mappanev/$fajl'></a>
                        </figure>
                    </div>
            ";
            }
        }
        closedir($mappa);
    ?>
</div>