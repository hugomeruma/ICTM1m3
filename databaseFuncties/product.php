<?php
require 'databaseFuncties.php';

function productenBeherenOverzicht(int $limit, int $page = 0)
{
    $offset = $page * $limit;
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT stockitems.StockItemID, stockitems.StockItemName, stockitems.UnitPrice FROM stockitems LIMIT ? OFFSET ?");
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

function haalProductOpID($id)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT * FROM stockitems WHERE StockItemID = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
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

function zoekProductenOpNaam($name)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function tellenProducten($where = null)
{
    if ($where != null) {
        $count = "SELECT count(*) as aantalProducten FROM StockItems as SI JOIN stockitemstockgroups as SG
                    ON SI.StockItemID = SG.StockItemID
                    WHERE SG.StockGroupID = ?;";
    } else {
        $count = "SELECT count(*) as aantalProducten FROM StockItems;";
    }
    $result = getFromDB($count, $where);
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['aantalProducten']);
}