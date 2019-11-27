<?php
$product = getStockItem($_GET['view']);

$prijs = $product["UnitPrice"] * (($product["UnitPrice"] / 100) + 1);