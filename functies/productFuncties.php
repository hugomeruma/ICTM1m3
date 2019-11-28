<?php
$product = getStockItem($_GET['view']);
$stock = getStockHolding($product['StockItemID']);

function price($priceExcl, $taxrate)
{
    $price = $priceExcl * (($taxrate / 100) + 1);
    return number_format($price, 2);
}


