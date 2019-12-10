<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/product.php";

if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    require 'categorie.php';
} else {
    require 'home.php';
}

require __DIR__ . "/parts/footer.php";