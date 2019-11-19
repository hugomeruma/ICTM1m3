<?php
require 'databaseFuncties.php';

function productenBeherenOverzicht($limit, $page = 0)
{
    $offset = $page * $limit;
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT stockitems.StockItemID, stockitems.StockItemName, stockitems.unitPrice FROM stockitems LIMIT ? OFFSET ?");
    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function telPaginas($productenPerPagina)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT COUNT(*) as totaal FROM stockitems");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['totaal'] / $productenPerPagina);
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