<?php
//default functies verbinden
function maakVerbinding($user = null, $pass = null)
{
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";
    $connection = new mysqli($host, $user, $pass, $databasename, $port);
    return ($connection);
}

function getFromDB($sql, $where = null, $limit = null, $offset = null, $search = null)
{
    $conn = maakVerbinding();
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    if ($where != null && $limit == null && $offset == null && $search == null) {
        mysqli_stmt_bind_param($stmt, 'i', $where);
    }
    if ($where != null && $limit != null && $search != null) {
        mysqli_stmt_bind_param($stmt, 'isii', $where, $search, $limit, $offset);
    }
    if ($where == null && $limit != null && $search != null) {
        mysqli_stmt_bind_param($stmt, 'sii', $search, $limit, $offset);
    }
    if ($where != null && $limit != null && $search == null) {
        mysqli_stmt_bind_param($stmt, 'iii', $where, $limit, $offset);
    }
    if ($where == null && $limit != null && $search == null) {
        mysqli_stmt_bind_param($stmt, 'ii', $limit, $offset);
    }


    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    sluitVerbinding($conn);
    return $result;
}

function sluitVerbinding($connection)
{
    mysqli_close($connection);
}

//selecteren Producten
function offset($pp)
{
    $page = page();
    $offset = ($page - 1) * $pp;
    return $offset;
}

//ophalen browsen
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

//stockGroups
function selecterenStockgroups()
{
    $sql = "SELECT SG.StockGroupID, SG.StockGroupName 
FROM stockgroups as SG  WHERE SG.StockGroupID IN (SELECT StockGroupId FROM stockitemstockgroups)";
    return mysqli_fetch_all(getFromDB($sql), MYSQLI_ASSOC);
}

function currentStockGroup()
{
    if (empty($_GET['in'])) {
        return "Alle browsen";
    } else {
        $sql = "SELECT StockGroupName as StockGroupName FROM stockgroups WHERE StockGroupId = ?;";
        $result = getFromDB($sql, $_GET['in']);
        return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['StockGroupName']);
    }
}

function getStockGroup($where, $all = null)
{
    if (!empty($_GET['in']) && $all == null) {
        return $_GET['in'];
    } else {
        $sql = "SELECT StockGroupID FROM stockitemstockgroups where StockItemID = ?;";
    }
    $result = getFromDB($sql, $where);
    $nr = rand(0, mysqli_num_rows($result) - 1);
    if ($all != null) {
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    }
    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['StockGroupID']);
}

function getStockItem($stockItemID)
{
    $sql = "SELECT * FROM stockitems WHERE StockItemID = ?";
    $where = $stockItemID;
    return mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC);
}

function alleProducten()
{
    $count = tellenProducten(null);
    $limit = productenPerPagina($count);
    $offset = offset($limit);
    $sql = "SELECT * FROM stockitems LIMIT ? OFFSET ?";
    return mysqli_fetch_all(getFromDB($sql, null, $limit, $offset), MYSQLI_ASSOC);
}

function selecterenProducten()
{
    $where = $_GET['in'];
    $count = tellenProducten($where);
    $limit = productenPerPagina($count);
    $offset = offset($limit);
    $sql = "SELECT * FROM StockItems as I JOIN stockitemstockgroups as G
ON I.StockItemID = G.StockItemID
WHERE G.StockGroupID = ? LIMIT ? OFFSET ?";
    return mysqli_fetch_all(getFromDB($sql, $where, $limit, $offset), MYSQLI_ASSOC);
}


function zoekenProducten()
{
    if (empty($_GET['in'])) {
        $where = 6;
        $count = tellenProducten($where);
        $limit = productenPerPagina($count);
        $offset = offset($limit);
        $sql = "SELECT * FROM StockItems WHERE SearchDetails like ? 
LIMIT ? 
OFFSET ?";
        $search = "%" . $_GET['searchFor'] . "%";
        return mysqli_fetch_all(getFromDB($sql, $where, $limit, $offset, $search), MYSQLI_ASSOC);
    } elseif ((!empty($_GET['in']))) {
        $where = $_GET['in'];
        $count = tellenProducten($where);
        $limit = productenPerPagina($count);
        $offset = offset($limit);
        $sql = "SELECT * FROM StockItems as I JOIN stockitemstockgroups as G
ON I.StockItemID = G.StockItemID 
WHERE  G.StockGroupID = ? and SearchDetails like ?
LIMIT ? 
OFFSET ?";
        $search = "%" . $_GET['searchFor'] . "%";
        return mysqli_fetch_all(getFromDB($sql, $where, $limit, $offset, $search), MYSQLI_ASSOC);
    }
}
    ?>