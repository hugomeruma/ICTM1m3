<?php
require __DIR__ . "/../databaseFuncties/Reviews.php";

$product = getStockItem($_GET['view']);
$stock = getStockHolding($product['StockItemID']);

function price($priceExcl, $taxrate, $stockItemID = null)
{
    $price = $priceExcl * (($taxrate / 100) + 1);

    $off = checkDiscount($stockItemID);
    if ($off != null) {
        $discount = (100 - $off)/100;
        $price = $price * $discount;
    }

    return number_format($price, 2);
}

function checkDiscount($stockItemID = null, $stockGroupID = null) {
    if ($stockItemID != null){
        $discount = getDiscount($stockItemID);
    } else {
        $discount = getDiscount(null , $stockGroupID);
    }
    return $discount;
}

function stars($stop)
{
    for ($nr = 1; $nr < $stop; $nr = $nr + 2): ?>
        <i class="fas fa-star"></i>
    <?php
    endfor;
    if (($nr < 10)) {
        if (($nr - $stop) == 0):?>
            <i class="fas fa-star-half-alt"></i>
            <?php
            $nr++;
        endif;
    }
    $stop = ceil((10 - $nr) / 2);
    for ($nr = 0; $nr < $stop; $nr++):?>
        <i class="far fa-star"></i>
    <?php
    endfor;
}

?>
