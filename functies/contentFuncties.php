<?php
include $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/databaseFuncties/databaseFuncties.php";
include "klantFuncties.php";
include "URL.php";

//bepaalt wat zichtbaar is een een scherm
function startScherm($filenaam)
{
    navigatieBalk($filenaam);
    //atm laat dit alle producten zien, hier moeten nog even producten voor geselecteerd worden

}

//zoekFunctie
//laat een text input zien

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

//Tonen Producten
function toonProducten()
{
    $producten = opvragenProducten();
    if (!empty($producten)) {
        foreach ($producten as $product) {
            $print = product($product);
            echo($print);
        }
    } else {
        echo "<br>Er zijn geen producten gevonden.<br>";
        return;
    }
}

function product($product)
{
    echo("
    <div class='product_lijst'>
    <h4>" . $product["StockItemName"] . "</h4>
</div>
    ");
    return;
}


//paginationFunctie

function paginationPrint($aantalPaginas)
{
    for ($page = 1; $page <= $aantalPaginas; $page++) {
        $url = url('page=', $page);
        echo "<a href=$_SERVER[SERVER_NAME]'</a>";
    }
}


//producten per pagina kiezer
function ProductPerPaginaForm($pp)
{
    $page = $_GET['page'];
    if (!empty($_GET['in'])) {
        $in = $_GET['in'];
    } else $in = "";
    echo "<form action='' method='get'> 
Resultaten per pagina 
<input type=\"number\" name=\"pp\" min=\"10\" max=\"50\" step=\"10\" value=\"$pp\">
<input type=\"hidden\" name=\"page\" value=\"$page\"> 
<input type=\"hidden\" name=\"in\" value=\"$in\">
</form>";

}

//navbar items

?>