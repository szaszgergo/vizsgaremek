<?php

$uid = $_SESSION["uid"] ?? $_SESSION["2fa_uid"];
$sql = "SELECT * FROM user WHERE uID='$uid' AND u2FAStatus=1";

$result = sqlcall($sql);
if ($result->num_rows > 0) {
    $on = true;
} else {
    $on = false;
}

if (isset($_SESSION["2fa_uid"])) {
    unset($_SESSION["2fa_uid"]);
}
?>

<div class="col-md-8">
    <form enctype="multipart/form-data" class="profile-container" action="actions/fiok_adat_valtoztatas.php" method="POST" target="kisablak"
        id="inputcontainer">
        <div class="profile-header">
            <?php
            $profilePic = empty($adatok['uProfilePic']) ? '../images/pic.png' : 'profile_pic/' . $adatok['uProfilePic'];
            ?>
            <img style="object-fit: cover;" src="<?= $profilePic ?>" alt="Profile Picture">
            <div>
                <h2><?= htmlspecialchars($adatok['uSzuleteskorinev']) ?></h2>
                <p>@<?= htmlspecialchars($adatok['uFelhasznalonev']) ?></p>
            </div>
            <button type="button" class="edit-btn" id="edit-btn"><?= $languageContent["edit"] ?></button>
        </div>

        <div class="mb-3">
            <label for="InputUsername" class="form-label"><?= $languageContent["usernameLabel"] ?></label>
            <input value="<?= htmlspecialchars($adatok['uFelhasznalonev']) ?>" type="text"
                class="form-control fiok-input" id="InputUsername" name="username" maxlength="100" readonly>
        </div>

        <div class="mb-3">
            <label for="InputRealName" class="form-label"><?= $languageContent["RealNameLabel"] ?></label>
            <input value="<?= htmlspecialchars($adatok['uSzuleteskorinev']) ?>" type="text"
                class="form-control fiok-input" id="InputRealName" name="realname" maxlength="100" readonly>
        </div>

        <div class="mb-3">
            <label for="InputEmail" class="form-label"><?= $languageContent["emailLabel"] ?></label>
            <input value="<?= htmlspecialchars($adatok['uemail']) ?>" type="email" class="form-control fiok-input"
                id="InputEmail" name="email" maxlength="256" readonly>
        </div>

        <div class="mb-3">
            <label for="InputDate" class="form-label"><?= $languageContent["birthdateLabel"] ?></label>
            <input value="<?= htmlspecialchars($adatok['uSzuletesidatum']) ?>" type="date"
                class="form-control fiok-input" id="InputDate" name="date" readonly>
        </div>

        <div class="mb-3">
            <label for="InputPic" class="form-label"><?= $languageContent["newProfilePic"] ?></label>
            <input type="file" class="form-control fiok-input" id="InputPic" name="upic" disabled>
        </div>

        <div class="mb-3">
            <p><?= $languageContent["pwChange"] ?></p>

        </div>



        <button style="display: none;" type="submit" class="btn-save"
            id="btn-save"><?= $languageContent["saveChanges"] ?></button>
    </form>

</div>

<form action="actions/enable_2fa.php" method="POST" target="kisablak">
    <button type="submit" class="btn btn-success" <?= ($on===true) ? "disabled" : "" ?>><?= $languageContent["2FATurnOn"] ?></button>
</form>
 <div>
    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#login2fa" <?= ($on===false) ? "disabled" : "" ?>><?= $languageContent["2FATurnOff"] ?></button>
 </div>
  