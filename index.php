<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/product.php";

if (isset($_GET['reviewOpslaan'])) {
    require __DIR__ . "/reviewOpslaan.php";
}
?>

<div id="content-wrap" class="container" style="padding: 2.5rem">
<?php
if (isset($_POST['toevoegenAanWinkelwagen']) or isset($_GET['toonWinkelWagen'])) {
    require "winkelwagen.php";
} elseif (isset($_GET['product'])) {
    require 'product.php';
} elseif (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    require 'categorie.php';
} else {
    require 'home.php';
}
?>
</div>


<?php
require __DIR__ . "/parts/footer.php";
?>

