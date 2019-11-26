<?php
require __DIR__ . "/../databaseFuncties/databaseFuncties.php";
include "klantFuncties.php";
include "URL.php";

//Default van het search veld,
//Als er niks is gezocht: 'Type hier om te zoeken'
//Als er wel gezocht is 'laten zie van het zoekwoord'
function searchFor()
{
    if (isset($_GET['searchFor'])) {
        $searchFor = $_GET['searchFor'];
        //zoeken($searchFor);
        return $_GET['searchFor'];
    } else {
        return 'Zoeken...';
    }
}

function imgIDs()
{
//    maak een array voor ID's
    $imgIDs = catImageIDs();
    return $imgIDs;
//   afbeeldingen vcor catagorien als er geen andere beschik baar zijn
}

function catImageIDs()
{
    $stockItemID = $_GET['view'];
    $imgIDs = (getStockGroup($stockItemID, 1));

    if (!empty($_GET['in'])) {
        array_unshift($imgIDs, Array("StockGroupID" => $_GET['in']));
    }
    $check = array();
    foreach ($imgIDs as $id){
        $check[] = "cat".$id["StockGroupID"];
    }
    $newNames = array_unique($check);

    return $newNames;

}


?>