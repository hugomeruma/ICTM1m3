<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/product.php";

if (isset($_GET['reviewOpslaan'])) {
    require __DIR__ . "/reviewOpslaan.php";
}
?>

<?php
if (isset($_POST['toevoegenAanWinkelwagen']) or isset($_GET['toonWinkelWagen']) or isset($_GET['te-verwijderen-product'])) {
    require "winkelwagen.php";
} elseif (isset($_GET['product'])) {
    require 'product.php';
} else {
    $_GET['categorie'] = 'alle';
    require 'categorie.php';
}
require __DIR__ . "/parts/footer.php";
?>

