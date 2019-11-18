<?php
include "databaseFuncties/databaseFuncties.php";
include "klantFuncties.php";
include "URL.php";

//bepaalt wat zichtbaar is een een scherm
function startScherm()
{
    navigatieBalk();
    //atm laat dit alle producten zien, hier moeten nog even producten voor geselecteerd worden

}

//zoekFunctie
//laat een text input zien
function zoekenOptie($filenaam)//van de plaats waar uit je zoekt
{
    $searchFor = searchFor();
    echo("<form class=\"form-inline active-purple-3 active-purple-4\" action='' methot='get'>
  <i class=\"fas fa-search\" aria-hidden=\"true\"></i>
  <input type=\"text\" name='searchFor' class=\"form-control form-control-sm ml-3 w-75\" type=\"text\" placeholder=\"$searchFor\"
    aria-label=\"Search\">
</form>");

    return $searchFor;
}

//Default van het search veld,
//Als er niks is gezocht: 'Type hier om te zoeken'
//Als er wel gezocht is 'laten zie van het zoekwoord'
function searchFor()
{
    if (isset($_GET['searchFor'])) {
        $searchFor = $_GET['searchFor'];
        zoeken($searchFor);
        return $_GET['searchFor'];
    } else {
        return 'Type hier om te zoeken';
    }
}

//Tonen Producten
function toonProducten()
{
    $producten = opvragenProducten();
    if (!empty($producten)) {
        productTabelHoofd();
        foreach ($producten as $product) {
            productTabel($product);
        }
    } else {
        echo "<br>Er zijn geen producten gevonden.<br>";
        return;
    }
}

function productTabelHoofd()
{
    echo("
    <table class=\"table\"> 
    <thead class=\"thead-dark\">
        <tr>
            <th>StockItemID</th>
            <th>StockItemName</th>
            <th>UnitPrice</th>
            <th>RecommendedRetailPrice</th>
        </tr>
    </thead>
    <tbody>");
    return;
}

function productTabel($product)
{
    echo("<tr>" .
        "<td>" . $product["StockItemID"] . "</td>" .
        "<td>" . $product["StockItemName"] . "</td>" .
        "<td>" . $product["UnitPrice"] . "</td>" .
        "<td>" . $product["RecommendedRetailPrice"] . "</td>" .
        "</tr>");
    return;
}


//paginationFunctie
function pagination($aantalProducten)
{
    $pp = productenPerPagina();
    $_SESSION["pp"] = $pp;
    $aantalPaginas = aantalPaginas($aantalProducten, $pp);
    if ($aantalProducten > $pp) {
        paginationPrint($aantalPaginas);
    }
    return $pp;
}

function paginationPrint($aantalPaginas)
{
    for ($page = 1; $page <= $aantalPaginas; $page++) {
        $url = url('page=', $page);
        echo "<a href=$url>  $page  </a>";
    }
}

//aantalPaginas voor de resultaten
function aantalPaginas($aantalProducten, $pp)
{
    $aantalPaginas = ceil($aantalProducten / $pp);
    return $aantalPaginas;
}

//producten per pagina kiezer
function ProductPerPaginaForm($pp)
{
    echo "<form action='' method='get'> Resultaten per pagina <input type=\"number\" name=\"pp\" min=\"10\" max=\"50\" step=\"10\" value=\"$pp\"></form>";

}

//navigation bar
function navigatieBalk()
{
    echo("
<nav class=\"navbar navbar-light bg-light\">
  <a class=\"navbar-brand\" href=\"#\">Navbar
   <img src=\"assets/afbeeldingen/logo.png\" width=\"250\" height=\"90\" class=\"d-inline-block align-top\" alt=\"\">
  </a>
</nav>");
}

?>