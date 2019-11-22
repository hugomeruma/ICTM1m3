<div class="col-2">
    <img src="
    <?php
    $img = getStockGroup($product['StockItemID']);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/assets/afbeeldingen/cat" . $img . ".png")) {
        echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/cat" . $img . ".png");
    } else {
        echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/image_not_available.png");
    }
    ?>"
         class="img">

</div>

<div class="col-7 product-item_content py-2">

    <div class="product_info">
        <h5><?= $product['StockItemName'] ?></h5>
        <?php
        if (!empty($product['MarketingComments'])): ?>
            <h6><?= $product['MarketingComments'] ?></h6>
        <?php else: ?>
            <h6><?= $product['SearchDetails'] ?></h6>
        <?php endif; ?>
    </div>
    <!--    <a href="/ICTM1m3/product/?=--><? //= $product['StockItemID'] ?><!--" class="stretched-link"></a>-->
</div>
<div class="col-3 product_prijs" style="text-align: right">
    <h5 style="margin-bottom: 0px">€ <?= $product["UnitPrice"] ?>,-</h5>
    <span style="font-size: 12px">taxrate: <?= $product['TaxRate'] ?></span>
    <span style="font-size: 12px; font-weight: bold"><br>Recommended retail price: <br>
        € <?= $product["RecommendedRetailPrice"] ?>,-</span>
    <!--    <toevoegen aan winkelmandje><button> met icon /button>-->
</div>
