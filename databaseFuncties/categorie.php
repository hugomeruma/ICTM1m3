<?php
function haalCategorieënOp()
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare('SELECT SG.StockGroupID, SG.StockGroupName FROM stockgroups as SG  WHERE SG.StockGroupID IN (SELECT StockGroupId FROM stockitemstockgroups)');
    $result = $stmt->execute();
    $result = $stmt->get_result();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function haalCategorieNaamOpID(int $ID)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("SELECT StockGroupName FROM stockgroups WHERE StockGroupID = ?");
    $stmt->bind_param('i', $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["StockGroupName"];
}
