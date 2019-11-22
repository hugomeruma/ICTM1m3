<?php
include $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/databaseFuncties/databaseFuncties.php";
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

?>