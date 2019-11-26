<div class="col-2" style="">
    <img src="
    <?php
    $img = getStockGroup($product['StockItemID']);
    if (file_exists(__DIR__ . "/assets/afbeeldingen/cat" . $img . ".png")) {
        echo(getBaseUrl() . "/assets/afbeeldingen/cat" . $img . ".png");
    } else {
        echo(getBaseUrl() . "/assets/afbeeldingen/image_not_available.png");
    }
    ?>"
         class="img">
    <a href="displayproduct.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>" class="stretched-link"></a>
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
        <a href="displayproduct.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
           class="stretched-link"></a>
    </div>

</div>

<div class="col-3 product_prijs" style="text-align: right">
    <h5 style="margin-bottom: 0px">
        € <?= number_format($product["UnitPrice"] * (($product["UnitPrice"] / 100) + 1), 2) ?>,-</h5>
    <span style="font-size: 12px">incl. btw (<?= $product["UnitPrice"] / 100 ?>%) </span>

    <!--    <toevoegen aan winkelmandje><button> met icon /button>-->

</div>
