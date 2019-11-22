<?php
require 'databaseFuncties.php';

function productenBeherenOverzicht(int $limit, int $page = 0)
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

function telPaginas(int $productenPerPagina)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT COUNT(*) as totaal FROM stockitems");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['totaal'] / $productenPerPagina);
}

function haalProductOpID($id)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT * FROM stockitems WHERE StockItemID = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return (mysqli_fetch_all($result, MYSQLI_ASSOC));
}

function verwijderProducten(array $productenIDs)
{

    foreach ($productenIDs as $productID) {
        dd(haalProductOpID($productID));
        $stmt = $conn->prepare("DELETE");
        $stmt->bind_param('ii', $limit, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}