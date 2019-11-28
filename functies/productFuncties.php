<?php
require __DIR__ . "/../databaseFuncties/Reviews.php";

$product = getStockItem($_GET['view']);
$stock = getStockHolding($product['StockItemID']);

function price($priceExcl, $taxrate)
{
    $price = $priceExcl * (($taxrate / 100) + 1);
    return number_format($price, 2);
}

function stars($counter)
{
    $stars = "";
    for ($nr = 0; $nr <= $counter; $nr++) {
        if (($nr % 2) == 0) {
            echo "$nr is even!<br>";
        } else {
            echo "$nr is odd!<br>";
        }
    }
    return $stars;
}



