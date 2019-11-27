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
    if ($where != null && $limit == null && $search == null) {
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
    if ($where == null && $limit == null && $search != null) {
        mysqli_stmt_bind_param($stmt, 's', $search);
        dd($search);
    }
    if ($where != null && $limit == null && $search != null) {
        mysqli_stmt_bind_param($stmt, 'is', $where, $search);
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
function tellenProducten($where = null, $search = null)
{
//    tellen catagorie, alleen een where
    if ($where != null && $search == null) {
        $count = "SELECT count(*) as amount FROM StockItems as SI JOIN stockitemstockgroups as SG
ON SI.StockItemID = SG.StockItemID
WHERE SG.StockGroupID = ?;";
        $result = getFromDB($count, $where);
    }
//   tellen alle producten helemaal niks.
    if ($where == null && $search == null) {
        $count = "SELECT count(*) as amount FROM StockItems;";
        $result = getFromDB($count);

    }
//    tellen in alle resultaten. Alleen een search.
    if ($where == null && $search != null) {
        echo "<h1>TEST<h1>";
        die;
        $count = "SELECT count(*) as amount FROM StockItems WHERE SearchDetails like ? ";

        $result = getFromDB($count, null, null, null, $search);
    }
//    tellen in een catagorie, een where en een search
    if ($where != null && $search != null) {
        $count = "SELECT count(*) as amount FROM StockItems as I JOIN stockitemstockgroups as G
ON I.StockItemID = G.StockItemID 
WHERE  G.StockGroupID = ? and SearchDetails like ?";
        $result = getFromDB($count, $where, null, null, $search);
    }

    return (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['amount']);
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

function getColor($ColorID)
{
    $sql = "SELECT ColorName FROM colors WHERE ColorID = ?";
    $where = $ColorID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]['ColorName']);
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
    if ($_GET['in'] == "") {
        $search = "%" . $_GET['searchFor'] . "%";

        $count = tellenProducten(null, $search);
        $limit = productenPerPagina($count);
        $offset = offset($limit);

        $sql = "SELECT * FROM StockItems WHERE SearchDetails like ? 
LIMIT ? 
OFFSET ?";
        return mysqli_fetch_all(getFromDB($sql, null, $limit, $offset, $search), MYSQLI_ASSOC);
    } elseif (!empty($_GET['in'])) {
        $where = $_GET['in'];
        $search = "%" . $_GET['searchFor'] . "%";

        $count = tellenProducten($where, $search);
        $limit = productenPerPagina($count);
        $offset = offset($limit);
        $sql = "SELECT * FROM StockItems as I JOIN stockitemstockgroups as G
ON I.StockItemID = G.StockItemID 
WHERE  G.StockGroupID = ? and SearchDetails like ?
LIMIT ? OFFSET ? ";
        return mysqli_fetch_all(getFromDB($sql, $where, $limit, $offset, $search), MYSQLI_ASSOC);
    }
}


?>