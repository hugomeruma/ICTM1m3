<?php if ($deal['StockItemID'] != null): ?>

    <div class="container col banner-base justify-content-center my-5">
        <img src="
    <?php
        $img = imgIDs($deal["StockItemID"], true);
        echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
        ?>"
             class="banner-image col">
        <?php if (getDiscount($deal['StockItemID']) != null): ?>
            <div class="discount-icon-div-on-item">
                <span class="fa-stack discount-icon-on-item">
                    <i class="fas fa-certificate fa-stack-2x"></i>
                    <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        <?php endif ?>
        <div class="banner-text col">
            <?= $deal['DealDescription'] ?>
        </div>

        <a class="stretched-link " href="<?= getBaseUrl() ?>product?view=<?= $deal['StockItemID'] ?>"></a>
    </div>


<?php endif;
if ($deal['StockGroupID'] != null): ?>

    <div class="container col banner-base mt-5">

        <div class="banner-text d-inline">
            <?= $deal['DealDescription'] ?>
        </div>

        <a class="stretched-link " href="<?= getBaseUrl() ?>browsen/?in=<?= $deal['StockGroupID'] ?>&page=1&pp=10"></a>
    </div>
<?php endif; ?>