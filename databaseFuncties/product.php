<?php
function telProducten($categorieID)
{
    $conn = maakVerbinding();
    if ($categorieID) {
        $stmt = $conn->prepare("SELECT COUNT(*) as totaal 
        FROM stockitems s
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ?");
        $stmt->bind_param('i', $categorieID);
    } else {
        $stmt = $conn->prepare("SELECT COUNT(*) as totaal FROM stockitems");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['totaal']);
}

function telGezochteProducten(string $zoekOpdracht, $categorieID = null)
{
    $conn = maakVerbinding();
    $zoekOpdracht = "%{$zoekOpdracht}%";
    if ($categorieID) { // Zoeken binnen een categorie
        $stmt = $conn->prepare("SELECT COUNT(*) as totaal 
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ?
        AND (s.SearchDetails LIKE ? OR s.StockItemName LIKE ?)");
        $stmt->bind_param('iss', $categorieID, $zoekOpdracht, $zoekOpdracht);
    } else { // Zoeken in alle producten
        $stmt = $conn->prepare("SELECT COUNT(*) as totaal 
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE (s.SearchDetails LIKE ? OR s.StockItemName LIKE ?)");
        $stmt->bind_param('ss', $zoekOpdracht, $zoekOpdracht);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['totaal']);
}

function haalProductOpID(int $id)
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

function zoekProducten(string $zoekOpdracht, int $pagina, int $productenPerPagina, $categorieID = null)
{
    $offset = $pagina * $productenPerPagina - $productenPerPagina;
    $conn = maakVerbinding();
    $zoekOpdracht = "%{$zoekOpdracht}%";
    if ($categorieID) { // Zoeken binnen een categorie
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand
        FROM stockitems s
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ?
        AND (s.SearchDetails LIKE ? OR s.StockItemName LIKE ?)
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
        WHERE (s.SearchDetails LIKE ? OR s.StockItemName LIKE ?)
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
    $offset = $pagina * $productenPerPagina - $productenPerPagina;

    $conn = maakVerbinding();
    if ($categorieID) { // Haal alle producten van een categorie
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand, g.StockGroupID, (SELECT COUNT(*) FROM reviews r WHERE r.StockItemID = s.StockItemID) as aantalBeoordelingen, AVG(r.Rating) as gemiddeldeBeoordeling,
        (SELECT i.location FROM stockgroups_images si LEFT JOIN images i ON i.ID = si.imageID  WHERE si.StockGroupID = g.StockGroupID LIMIT 1) as afbeeldingLocation
        FROM stockitems s
        LEFT JOIN reviews r
        ON s.StockItemID = r.StockItemID
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE g.StockGroupID = ? AND h.QuantityOnHand > 0
        GROUP BY s.StockItemID
        LIMIT ?
        OFFSET ?");

        $stmt->bind_param('iii', $categorieID, $productenPerPagina, $offset);
    } else { // Haal alle producten
        $stmt = $conn->prepare("SELECT s.StockItemID, s.StockItemName, s.MarketingComments, s.Tags, s.UnitPrice, s.TaxRate, h.QuantityOnHand, g.StockGroupID, (SELECT COUNT(*) FROM reviews r WHERE r.StockItemID = s.StockItemID) as aantalBeoordelingen, AVG(r.Rating) as gemiddeldeBeoordeling,
         (SELECT i.location FROM stockgroups_images si LEFT JOIN images i ON i.ID = si.imageID  WHERE si.StockGroupID = g.StockGroupID LIMIT 1) as afbeeldingLocation
         FROM stockitems s
        LEFT JOIN reviews r
        ON s.StockItemID = r.StockItemID
        JOIN stockitemholdings h
        ON s.StockItemID = h.StockItemID
        LEFT JOIN stockitemstockgroups g
        ON s.StockItemID = g.StockItemID
        WHERE h.QuantityOnHand > 0
        GROUP BY s.StockItemID
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

function haalWinkelwagenProductOp(int $productID)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT StockItemID, StockItemName, UnitPrice FROM stockitems WHERE StockItemID = ?");
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function haalEersteProductAfbeeldingOp(int $productID)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT i.location, i.alt, i.title FROM stockitems_images s LEFT JOIN images i ON i.ID = s.ImageID WHERE s.StockItemID = ? LIMIT 1");
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC)[0] ?? null;
}

function haalEersteCategorieAfbeeldingVanProductOp(int $categorieID)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT i.location, i.alt, i.title FROM stockgroups_images s LEFT JOIN images i ON i.ID = s.imageID WHERE s.StockgroupID = ? LIMIT 1");
    $stmt->bind_param('i', $categorieID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC)[0] ?? '';
}