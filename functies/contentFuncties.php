<?php
include "../databaseFuncties/databaseFuncties.php";
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
function zoekenOptie($filenaam)//van de plaats waar uit je zoekt
{
    $searchFor = searchFor();
    return "
<form action='$filenaam' method='get'>
  <input type=\"search\" name='searchFor' class=\"form-control\" type=\"text\" placeholder=\"$searchFor\" aria-label=\"$searchFor\">
</form>";
}

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
    if ($pp < 10 or $pp > 50) {
        $pp = 10;
        echo $pp;
        echo $aantalProducten;
    }
    $prodPagina = $pp;
    $aantalPaginas = ceil($aantalProducten / $prodPagina);
    return $aantalPaginas;
}

//producten per pagina kiezer
function ProductPerPaginaForm($pp)
{
    echo "<form action='' method='get'> Resultaten per pagina <input type=\"number\" name=\"pp\" min=\"10\" max=\"50\" step=\"10\" value=\"$pp\"></form>";

}

//navbar items
function logo()
{
    return "<a class=\"navbar-brand\" href=\"#\">
        <img src=\"assets/afbeeldingen/logo.png\" width=\"150\" height=\"54\" class=\"d-inline-block align-top\" alt=\"\">
        </a>";
}

function displayDropdownStockgroups()
{
    echo "<li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\"
                   aria-haspopup=\"true\" aria-expanded=\"false\">Categorieën
                </a>";

    displayStockgroup();

    echo "</li>";
}

function displayStockgroup()
{
    $stockgroups = ophalenStockgroups();
    if (!empty($stockgroups)) {
        echo "<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">";
        foreach ($stockgroups as $stockgroup) {
            echo "<a class=\"dropdown-item\" href=\"#\">" . $stockgroup['StockGroupName'] . "</a>";
        }
        echo "</div>";
    }
}

?>