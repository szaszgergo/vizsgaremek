<?php
$adatok = getUserInfo();
$jegy = getUserJegyek();
if (isset($jegy)) {
    $jtid = $jegy[2];
    $tipusadatok = getJegyTipusAdatok($jtid);
    $src = "https://api.qrserver.com/v1/create-qr-code/?data=$adatok[uUID]&size=5000x5000&margin=10";
    $remaining = strtotime($jegy[4]) - time();
    $maradek_napok = round($remaining / 86400);
    $szoveg = "
    <>
    <h3>$tipusadatok[1]</h3>
    <a href='$src'><img src='$src' alt='<?php echo $adatok[uUID]?>' title='JEGY' class='qr'  /></a>
    <h4> ". htmlspecialchars($languageContent["ervenyes"]) ." </h4>
    <h1 class='gold'>$maradek_napok ". htmlspecialchars($languageContent["nap"]) ."</h1>";
    if (!is_null($jegy[5])) {
        $szoveg .= "<h3>". htmlspecialchars($languageContent["hasznalatok"]) ." <span class='gold'> $jegy[5]</span></h3>";
    }
} else{
    $szoveg = "<h1>". htmlspecialchars($languageContent["nincsJegy"]) ."</h1> <a class='btn btn-warning' href='?o=jegyvasarlasform'>". htmlspecialchars($languageContent["vasarlas"]) ."</a>";
}

?>
<div class="row fiokrow">
    <div class="col-md-8 ">
        <form class="profile-container" action="actions/updateaction.php" method="post" target='kisablak' enctype="multipart/form-data" id="inputcontainer">
            <div id='error-message' class='alert alert-danger' style='display: none;'></div>
            
            <div class="profile-header">
                <img style="object-fit: cover;" src="<?php $a= 'profile_pic/' . (empty($adatok['uProfilePic']) ? '../images/pic.png' : $adatok['uProfilePic']); echo $a; ?>" alt="Profile Picture">
                <div>
                    <h2><?= $languageContent["name"] ?></h2>
                    <p>@<?php echo $adatok['uFelhasznalonev'] ?></p>
                </div>
                <button type="button" class="edit-btn" id="edit-btn"><?= $languageContent["edit"] ?></button>
            </div>

            <div class="mb-3">
                <label for="InputUsername" class="form-label"><?= $languageContent["usernameLabel"] ?></label>
                <input value="<?php echo $adatok['uFelhasznalonev'] ?>" type="text" class="form-control fiok-input" id="InputUsername" name="username" maxlength="100" readonly>
            </div>

            <div class="mb-3">
                <label for="InputEmail" class="form-label"><?= $languageContent["emailLabel"] ?></label>
                <input value="<?php echo $adatok['uemail'] ?>" type="email" class="form-control fiok-input" id="InputEmail" name="email" maxlength="256" readonly>
            </div>

            <div class="mb-3">
                <label for="InputDate" class="form-label"><?= $languageContent["birthdateLabel"] ?></label>
                <input value="<?php echo $adatok['uSzuletesidatum'] ?>" type="date" class="form-control fiok-input" id="InputDate" name="date" readonly>
            </div>

            <div class="mb-3">
                <label for="InputPic" class="form-label"><?= $languageContent["newProfilePic"] ?></label>
                <input type="file" class="form-control fiok-input" id="InputPic" name="upic" disabled>
            </div>

            <div class="mb-3">
                <p><?= $languageContent["pwChange"] ?></p>
            </div>

            <button style="display: none;" type="submit" class="btn-save" id="btn-save"><?= $languageContent["saveChanges"] ?></button>

        </form>
    </div>
    <div class="col-md-4 jegy">
        <?php echo $szoveg;?>
        <button class="btn btn-warning btn-new" data-bs-toggle='modal' data-bs-target='#vasarlasielozmenypopup'>Számlázás</button>
    </div>
    </div>