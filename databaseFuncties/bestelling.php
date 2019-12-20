<?php
function maakBestelling(int $klantID, string $plaats, string $postcode, string $huisnummer, string $street)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("INSERT INTO webshop_orders (CustomerID, City, PostalCode, HouseNumber, Street) VALUES(?,?,?,?,?)");
    $stmt->bind_param('issss', $klantID, $plaats, $postcode, $huisnummer, $street);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    // Return id van toegevoegde klant
    return $conn->insert_id;
}

function maakBestellingsRegel(int $bestellingID, int $productID, int $aantal, string $productNaam, string $prijs, string $belastingInProcenten)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("INSERT INTO webshop_orderlines (WebshopOrderID, StockItemID, Amount, StockItemName, RecommendedRetailPrice, TaxRate) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param('iiisss', $bestellingID, $productID, $aantal, $productNaam, $prijs, $belastingInProcenten);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}