<?php

//Verwerkt variable en post naar een URL die gebruikt kan worden op de volgende pagina.
//in functie url, kan tot nu toe 1 post worden gestopt, deze wordt allen gebruikt in de functie page.
//Als het goed is blijft searchFor gewoon bestaan, er moet hier weer na gekeken worden als browsen in categorien wordt toegevoed.
function url($post, $var)
{
    //searchFor
    $searchFor = searchForURL("searchFor=");
    //page
    if ($post == "page=") {
        $page = pageURL($post, $var);
    } else {
        $page = pageURL("page=", 1);
    }
    //Product Per pagina URL
    $pp = ppURL("pp=");
    return "?" . "$searchFor" . "$page" . "$pp";
}

function searchForURL($searchFor)
{
    if (isset($_GET['searchFor'])) {
        $searchFor .= $_GET['searchFor'] . "&";
    } else {
        $searchFor = "&";
    }
    return $searchFor;
}

function pageURL($page, $nr)
{
    $page .= $nr . "&";
    return $page;
}

function ppURL($pp)
{
    if (isset($_GET['pp'])) {
        $pp .= $_GET['pp'] . "&";
    } else {
        $pp .= "10&";
    }
    return $pp;
}

?>

