<?php

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
    $prodPagina = $pp;
    $aantalPaginas = ceil($aantalProducten / $prodPagina);
    return $aantalPaginas;
}

