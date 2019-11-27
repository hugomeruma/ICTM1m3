<?php
$product = getStockItem($_GET['view']);

function price($priceExcl, $taxrate)
{
    return ($priceExcl * ($taxrate / 100) + 1);
}
