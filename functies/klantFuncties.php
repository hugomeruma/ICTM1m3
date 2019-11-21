<?php

//Onderscheiden of de klant in een catagorie zoekt of niet
function zoeken($searchFor)
{
    if (isset($_GET['in'])) {
        $in = $_GET['in'];
        echo "Zoeken naar $searchFor in $in";
        return;
    } else {
        echo "Zoeken naar $searchFor";
        return;
    }
}

//opvragen van producten
function opvragenProducten()
{
    //alleproducten laten zien.
    if (empty($_GET['in']) && !isset($_GET['searchFor'])) {
        return alleProducten();
    } elseif (!empty($_GET['in']) && !isset($_GET['searchFor'])) {
        return selecterenProducten();
    }
}

//producten per pagina
function productenPerPagina()
{
    if (isset($_GET['pp'])) {
        $pp = $_GET['pp'];
    } else {
        $pp = 10;
    }
    return $pp;
}

function page()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    settype($page, 'integer');
    return $page;
}

function paginaNummering($huidigePagina, $totaalPaginas)
{
    $paginaNummers = [];
    if ($huidigePagina <= 1) { // Wanneer je bij het begin van de pagina's bent
        $paginaNummers['selected'] = 1;
        if ($totaalPaginas >= 2) {
            $paginaNummers[1] = 2;
        }
        if ($totaalPaginas >= 3) {
            $paginaNummers[2] = 3;
        }
    } elseif ($huidigePagina >= round($totaalPaginas)) { // Wanneer je aan het einde van de pagina's bent
        $paginaNummers[0] = $huidigePagina - 2;
        $paginaNummers[1] = $huidigePagina - 1;
        $paginaNummers['selected'] = $huidigePagina;
    } else { // De 'normal case'
        $paginaNummers[0] = $huidigePagina - 1;
        $paginaNummers['selected'] = $huidigePagina;
        $paginaNummers[2] = $huidigePagina + 1;
    }
    return $paginaNummers;
}


//aantalPaginas voor de resultaten
function telPaginas($aantalProducten, $pp)
{
    if ($pp < 10 or $pp > 50) {
        $pp = 10;
    }
    $prodPagina = $pp;
    $aantalPaginas = ceil($aantalProducten / $prodPagina);
    return $aantalPaginas;
}

