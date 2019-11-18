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
    if (!isset($_GET['in']) && !isset($_GET['searchFor'])) {
        return alleProducten();
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
    ProductPerPaginaForm($pp);
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
