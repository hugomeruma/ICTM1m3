<?php

require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";


echo "<br><br>";
if(isset($_POST['StockItemID']))
{

    if(isset($_SESSION['producten'][$_POST['StockItemID']]))
    {
        $i = $_SESSION['producten'][$_POST['StockItemID']] + 1;
    }
    else
    {
        $i = 1;
    }
    $_SESSION['producten'][$_POST['StockItemID']] = $i;
}

$winkelwagen = array();
if(isset($_SESSION['producten'])){
    $winkelwagen = getStockItems($_SESSION['producten']);
}

$totaalorder = 0;
foreach($winkelwagen as $value)
{

    //Naam item
    echo $value['StockItemName'];
    echo "<br>";
    //Aantallen item
    echo $_SESSION['producten'][$value['StockItemID']];
    echo "<br>";
    //Retail prijs
    echo $value['RecommendedRetailPrice'];
    echo "<br>";
    //Aantallen item * de retailprijs = totaal prijs per item
    echo "Subtotaal =".$_SESSION['producten'][$value['StockItemID']] * $value['RecommendedRetailPrice'];
    echo "<br>";

    $totaalorder += $_SESSION['producten'][$value['StockItemID']] * $value['RecommendedRetailPrice'];
}
echo "Totaalprijs = ".$totaalorder;

// SELECT * FROM `stockitems` WHERE StockItemId  IN (array_keys($_SESSION['producten']))

//Delete


die();


require __dir__ . "/../parts/footer.php";
?>