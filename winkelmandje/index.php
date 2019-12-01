<?php

require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";


if (isset($_POST['StockItemID'])) {

    if (isset($_SESSION['producten'][$_POST['StockItemID']])) {
        $i = $_SESSION['producten'][$_POST['StockItemID']] + 1;
    } else {
        $i = 1;
    }
    $_SESSION['producten'][$_POST['StockItemID']] = $i;
}
//dd($_SESSION);
if (isset($_POST['opslaan'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'product') !== false) {
            str_replace('product', '', $key);
            $_SESSION['producten'][$key] = $value;
        }
    }
    redirect('winkelmandje/');
}

$winkelwagen = array();
if (isset($_SESSION['producten'])) {
    $winkelwagen = getStockItems($_SESSION['producten']);
}

$totaalorder = 0;

//foreach($winkelwagen as $value)
//{
//
//    //Naam item
//    echo $value['StockItemName'];
//    echo "<br>";
//    //Aantallen item
//    echo $_SESSION['producten'][$value['StockItemID']];
////    echo "<br>";
////    //Retail prijs
////    echo $value['RecommendedRetailPrice'];
////    echo "<br>";
////    //Aantallen item * de retailprijs = totaal prijs per item
////    echo "Subtotaal =".$_SESSION['producten'][$value['StockItemID']] * $value['RecommendedRetailPrice'];
////    echo "<br>";
////
////    $totaalorder += $_SESSION['producten'][$value['StockItemID']] * $value['RecommendedRetailPrice'];
////}

// SELECT * FROM `stockitems` WHERE StockItemId  IN (array_keys($_SESSION['producten']))


?>
<div class="container">
    <form method="post">
    <?php
    foreach ($winkelwagen as $product):
        ?>
        <div class="container row product_kaart my-4">
            <?php require "parts/item.php" ?>


        </div>
    <?php
    endforeach;
    ?>
<button type="submit" name="opslaan">test</button>
    </form>
</div>

<?php



require __dir__ . "/../parts/footer.php";
?>