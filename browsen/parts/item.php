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

<div class="col-3 product_prijs" style="text-align: right">
    <h5 style="margin-bottom: 0px">
        <?php if(getDiscount($product['StockItemID']) != null):?>
            <span class="€discount"> € <?= price($product["UnitPrice"], $product["TaxRate"], $product['StockItemID']) ?>,-</span>
        <?php else: ?>
            <span class="€"> € <?= price($product["UnitPrice"], $product["TaxRate"], $product['StockItemID']) ?>,-</span>
        <?php endif; ?>
    </h5>
    <span style="font-size: 12px">incl. btw (<?= $product["UnitPrice"] / 100 ?>%) </span>
    <br>
    <span style="font-size: 12px"><?php echo "vooraad" ?></span>

    <!--    <toevoegen aan winkelmandje><button> met icon /button>-->

</div>

<?php

?>