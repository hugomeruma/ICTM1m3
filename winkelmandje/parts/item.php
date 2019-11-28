<?php
?>

<div class="col-2" style="">

    <!--  DIT IS HET BEGIN VAN DE AFBEELDING  -->
    <img src="
    <?php
    $img = imgIDs($product["StockItemID"], true);
    echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
    ?>"
         class="img">
    <a href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
       class="stretched-link"></a>
</div>
<!-- DIT IS HET EINDE VAN DE AFBEELDING -->


<div class="col-7 product-item_content py-2">
    <div class="product_info">
        <h5><?= $product['StockItemName'] ?></h5>
    </div>
</div>
<?php
$prijs_per_stuk = price($product['UnitPrice'], $product['TaxRate']);
$subTotaal = $prijs_per_stuk * $_SESSION['producten'][$product['StockItemID']];
?>
<div class="col-3 product_prijs" style="text-align: right">
    <h5> € <?= $subTotaal ?>,-</h5>
    € <?= $prijs_per_stuk ?>,-
    <!--    <toevoegen aan winkelmandje><button> met icon /button>-->

</div>
