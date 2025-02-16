<div class="col-md-4 jegy">
    <?php if ($hasTicket): ?>
        <?php
        $jtid = $jegy["jtID"];
        $tipusadatok = getJegyTipusAdatok($jtid);
        $qrSrc = "https://api.qrserver.com/v1/create-qr-code/?data={$adatok['uUID']}&size=5000x5000&margin=10";
        $remainingDays = round((strtotime($jegy["jLejarat"]) - time()) / 86400);

        if (!isset($_SESSION["lang"])) {
            $_SESSION["lang"] = "hu";
        }

        ?>

        <h3><?= htmlspecialchars($tipusadatok["tpNev"]) ?></h3>
        <a href="<?= $qrSrc ?>">
            <img src="<?= $qrSrc ?>" alt="<?= htmlspecialchars($adatok['uUID']) ?>" title="JEGY" class="qr" />
        </a>

        <h4><?= htmlspecialchars($languageContent["ervenyes"]) ?></h4>
        <h1 class="gold"><?= $remainingDays ?>     <?= htmlspecialchars($languageContent["nap"]) ?></h1>

        <?php if (!is_null($jegy['jAlkalmak'])): ?>
            <h3><?= htmlspecialchars($languageContent["hasznalatok"]) ?> <span class="gold"><?= $jegy['jAlkalmak'] ?></span>
            </h3>
        <?php endif; ?>

    <?php else: ?>
        <h1><?= htmlspecialchars($languageContent["nincsJegy"]) ?></h1>
        <a class="btn btn-warning" href="?o=shop&view=passes"><?= htmlspecialchars($languageContent["vasarlas"]) ?></a>
    <?php endif; ?>

    <button class="btn btn-warning btn-new" data-bs-toggle="modal"
        data-bs-target="#vasarlasielozmenypopup">Számlázás</button>
</div>