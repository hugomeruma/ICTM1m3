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
    <?php
    $discount = false;
    if (getDiscount($product['StockItemID']) != null):
        $discount = true;
        ?>
        <div class="discount-icon-div-on-item">
                <span class="fa-stack discount-icon-on-item">
                    <i class="fas fa-certificate fa-stack-2x"></i>
                    <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
                </span>
        </div>
    <?php endif; ?>
</div>
<!-- DIT IS HET EINDE VAN DE AFBEELDING -->


<div class="col-7 product-item_content py-2">
    <div class="product_info">
        <h5><?= $product['StockItemName'] ?></h5>
    </div>
</div>
<?php
$teller = $_SESSION['producten'][$product['StockItemID']];

$prijs_per_stuk = price($product['UnitPrice'], $product['TaxRate'], $product['StockItemID']);
$subTotaal = $prijs_per_stuk * $teller;

$_SESSION['totaalWinkelmandje'] = $_SESSION['totaalWinkelmandje'] + $subTotaal;
?>
<div class="col-3 product_prijs" style="text-align: right">
    <h6>
        Prijs per stuk: € <?= $prijs_per_stuk ?>,-
    </h6>
    <h5>Sub-Totaal: € <?= $subTotaal ?>,-</h5>
    <div class="winkelmandje_form_group">
        <form method="post">
            <button type="Submit" name="StockItemID<?= $product['StockItemID'] ?>" value="0"
                    class="btn btn-primary button_winkelmandje_verw"><i class="fa fa-trash"
                                                                        aria-hidden="true"></i></button>
            <input type="hidden" name="opslaan" value="opslaan"
                   class="form teller_form">
        </form>

        <form method="post">
            <input type="number" value="<?= $teller ?>" name="StockItemID<?= $product['StockItemID'] ?>"
                   class="form teller_form">
            <input type="hidden" name="opslaan" value="opslaan"
                   class="form teller_form">
            <!--                </div>-->

    </div>
</div>


