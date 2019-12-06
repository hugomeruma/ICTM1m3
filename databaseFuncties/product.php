<?php
function productenBeherenOverzicht(int $productenPerPagina, int $page = 0)
{
    $offset = $page * $productenPerPagina;
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT stockitems.StockItemID, stockitems.StockItemName, stockitems.UnitPrice FROM stockitems LIMIT ? OFFSET ?");
    $stmt->bind_param('ii', $productenPerPagina, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function telProductenPagina($productenPerPagina)
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

function zoekProducten(string $zoekOpdracht, int $pagina, int $productenPerPagina, $categorieID = null)
{
    $offset = $pagina * $productenPerPagina;
    $conn = maakVerbinding();
    if ($categorieID) { // Zoeken binnen een categorie
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ?
        AND (s.SearchDetails LIKE CONCAT('%', ?, '%') OR s.StockItemName LIKE CONCAT('%', ?, '%'))
        LIMIT ?
        OFFSET ?");
        $stmt->bind_param('issii', $categorieID, $zoekOpdracht, $zoekOpdracht, $productenPerPagina, $offset);
    } else { // Zoeken in alle producten
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE s.SearchDetails LIKE CONCAT('%', ?, '%') OR s.StockItemName LIKE CONCAT('%', ?, '%')
        LIMIT ?
        OFFSET ?");
        $stmt->bind_param('ssii', $zoekOpdracht, $zoekOpdracht, $productenPerPagina, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function haalProductenOp(int $pagina, int $productenPerPagina, int $categorieID = null)
{
    $offset = $pagina * $productenPerPagina;
    $conn = maakVerbinding();
    if ($categorieID) { // Haal alle producten van een categorie
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ?
        LIMIT ?
        OFFSET ?");
        $stmt->bind_param('iii', $categorieID, $productenPerPagina, $offset);
    } else { // Haal alle producten
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        LIMIT ?
        OFFSET ?");
        $stmt->bind_param('ii', $productenPerPagina, $offset);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}