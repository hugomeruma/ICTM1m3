<?php

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
    } elseif ($huidigePagina >= ceil($totaalPaginas)) { // Wanneer je aan het einde van de pagina's bent
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

function getBaseUrl($base = 'localhost:8080')
{
    return 'http://' . $base . '/';
}

function redirect($path)
{
    echo "Location:" . getBaseURL() . $path;
    header("Location:" . getBaseURL() . $path);
    exit();
}

function standaardProductenPerPagina()
{
    return '10';
}

function haalGetVariabelenOpVoorUrl($getWaardes)
{
    $url = '?';
    $aantalWaardes = count($getWaardes);
    $aantalLoops = 1;
    foreach ($getWaardes as $key => $getWaarde) {
        $url .= $key . '=' . $getWaarde;
        if ($aantalLoops != $aantalWaardes) {
            $url .= '&';
        }
        $aantalLoops++;
    }
    return $url;
}