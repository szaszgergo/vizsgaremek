<div class="arak">
    <h1 class="text-center text-warning"><?= $languageContent["berletarak"] ?></h1>
    <div class="row">
        <div class="col-md-1"></div>
        
        <!-- Felnőtt -->
        <div class="col-md-5">
            <h2 class="text-warning section-title"><?= $languageContent["felnottek"] ?></h2>
            <table class="table table-borderless">
                <tr>
                    <th><?= $languageContent["tipus"] ?></th>
                    <th><?= $languageContent["ar"] ?></th>
                </tr>
                <?php foreach ($languageContent["berletek"] as $berlet): ?>
                    <tr>
                        <td><?= $berlet["tipus"] ?></td>
                        <td><?= $berlet["felnottek_ar"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Diák / Nyugdíjas -->
        <div class="col-md-5">
            <h2 class="text-warning section-title"><?= $languageContent["diak_nyugdijas"] ?></h2>
            <table class="table table-borderless">
                <tr>
                    <th><?= $languageContent["tipus"] ?></th>
                    <th><?= $languageContent["ar"] ?></th>
                </tr>
                <?php foreach ($languageContent["berletek"] as $berlet): ?>
                    <tr>
                        <td><?= $berlet["tipus"] ?></td>
                        <td><?= $berlet["diak_nyugdijas_ar"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
        <div class="col-md-1"></div>
    </div>

    <p><i><?= $languageContent["megjegyzes"] ?></i></p>
</div>