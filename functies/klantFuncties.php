<?php
//opvragen van browsen
function opvragenProducten()
{
    //alleproducten laten zien.
    if (empty($_GET['in']) && !isset($_GET['searchFor'])) {
        return alleProducten();
    } elseif (!empty($_GET['in']) && !isset($_GET['searchFor'])) {
        return selecterenProducten();
    } elseif (empty($_GET['in']) && isset($_GET['searchFor'])) {
        return zoekenProducten();
    }

}

//browsen per pagina
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

