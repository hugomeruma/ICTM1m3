<?php
require __DIR__ . "/../databaseFuncties/databaseFuncties.php";
include "klantFuncties.php";
include "URL.php";

//Default van het search veld,
//Als er niks is gezocht: 'Type hier om te zoeken'
//Als er wel gezocht is 'laten zie van het zoekwoord'
function searchFor()
{
    if (!empty($_GET['searchFor'])) {
        $searchFor = $_GET['searchFor'];
        return $_GET['searchFor'];
    } else {
        return 'Zoeken...';
    }
}

function imgIDs($stockitemID, $isThubmnail = null)
{
//    maak een array voor ID's
    $imgIDs = imageChooser($stockitemID);

    if ($isThubmnail != null) {
        return $imgIDs[0];
    } else {
        return $imgIDs;
    }
    return $imgIDs;
//   afbeeldingen vcor catagorien als er geen andere beschik baar zijn
}

function imageChooser($imgID)
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/assets/afbeeldingen/" . $imgID . "a.png")) {
        return itemImageIDs($imgID);
    } else {
        return catImageIDs($imgID);
    }
}

function itemImageIDs($imgID)
{

    return $imgIDs = array(0 => $imgID . "a", 1 => $imgID . "b", 2 => $imgID . "c");
}

function catImageIDs($stockitemID)
{
    $imgIDs = (getStockGroup($stockitemID, 1));

    if (!empty($_GET['in'])) {
        array_unshift($imgIDs, Array("StockGroupID" => $_GET['in']));
    }
    $check = array();
    foreach ($imgIDs as $id) {
        $check[] = "cat" . $id["StockGroupID"];
    }
    $newNames = array_unique($check);

    return $newNames;

}

?>