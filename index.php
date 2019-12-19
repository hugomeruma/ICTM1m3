<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/product.php";


if (isset($_GET['reviewOpslaan'])) {
    require __DIR__ . "/reviewOpslaan.php";
}

if (isset($_GET['klad'])) {
    require "klad.php";
} elseif (isset($_GET['product'])) {
    require 'viewProduct.php';
} elseif (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    require 'categorie.php';
} else {
    require 'home.php';
}


require __DIR__ . "/parts/footer.php";