<?php

?>
    <div class="col-2" style="">
        <img src="
    <?php
        $img = imgIDs($product["StockItemID"], true);
        echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
        ?>"
             class="img">
        <a href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
           class="stretched-link"></a>
        <?php if (getDiscount($product['StockItemID']) != null): ?>
            <div class="discount-icon-div-on-item">
                <span class="fa-stack discount-icon-on-item">
                    <i class="fas fa-certificate fa-stack-2x"></i>
                    <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-7 product-item_content py-2">

        <div class="product_info">
            <h5><?= $product['StockItemName'] ?></h5>
            <?php
            if (!empty($product['MarketingComments'])): ?>
                <h6><?= $product['MarketingComments'] ?></h6>
            <?php else: ?>
                <h6><?= $product['Tags'] ?></h6>
            <?php endif; ?>
            <a href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
               class="stretched-link"></a>
        </div>

    </div>

    <div class="col-3 product-prijs" style="text-align: right">

        <h5 style="margin-bottom: 0px">
            <div class="€"> € <?= price($product["UnitPrice"], $product["TaxRate"], $product['StockItemID']) ?>,-</div>
        </h5>


        <span style="font-size: 12px">incl. btw (<?= $product["UnitPrice"] / 100 ?>%) </span>
        <br>
        <span style="font-size: 12px"><?php echo "vooraad" ?></span>

        <!--    <toevoegen aan winkelmandje><button> met icon /button>-->

    </div>

<?php

?>