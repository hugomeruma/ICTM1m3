<?php
// default functies verbinden
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
    } //   tellen alle producten helemaal niks.
    elseif ($where == null && $search == null) {
        $count = "SELECT count(*) as amount FROM StockItems;";
        $result = getFromDB($count);

    }
//    tellen in alle resultaten. Alleen een search.
    if ($where == null && $search != null) {
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
    $aantalProd = (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['amount']);
    return $aantalProd;
}


function currentStockGroup()
{
    if (empty($_GET['in'])) {
        return "Alle producten";
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

function getStockItems($stockItemsArray)
{
    $stockItemsArray = implode(',', array_keys($stockItemsArray));
    $sql = "SELECT * FROM stockitems WHERE StockItemID IN ($stockItemsArray)";
    return mysqli_fetch_all(getFromDB($sql, null), MYSQLI_ASSOC);
}

function getStockHolding($stockItemID)
{
    $sql = "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?";
    $where = $stockItemID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]['QuantityOnHand']);
}

function getChillerStock($IsChillerStock)
{
    //
}

function getColor($ColorID)
{
    $sql = "SELECT ColorName FROM colors WHERE ColorID = ?";
    $where = $ColorID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]['ColorName']);
}

function alleProducten()
{
    $count = tellenProducten(null, null);
    $limit = productenPerPagina($count);
    $offset = offset($limit);
    $sql = "SELECT * FROM stockitems LIMIT ? OFFSET ?";
    return mysqli_fetch_all(getFromDB($sql, null, $limit, $offset), MYSQLI_ASSOC);
}

function selecterenProducten()
{
    $where = $_GET['in'];
    $count = tellenProducten($where, null);
    $limit = productenPerPagina($count);
    $offset = offset($limit);
    $sql = "SELECT * FROM StockItems as I JOIN stockitemstockgroups as G
ON I.StockItemID = G.StockItemID
WHERE G.StockGroupID = ? LIMIT ? OFFSET ?";
    return mysqli_fetch_all(getFromDB($sql, $where, $limit, $offset), MYSQLI_ASSOC);
}

function getSpecialDeals()
{
    $sql = "SELECT * FROM specialdeals;";
    return mysqli_fetch_all(getFromDB($sql), MYSQLI_ASSOC);
}

//function getDiscount($stockItemID = null, $stockGroupID = null)
//{
//    if ($stockItemID !=null) {
//        $sql = "SELECT DiscountPercentage
//FROM specialdeals
//WHERE StockItemID = ?";
//        $where = $stockItemID;
//        $discount = (mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC)["DiscountPercentage"]);
//        if (!empty($discount['DiscountPercentage'])) {
//
//            return $discount['DiscountPercentage'];
//        } else {
//            foreach (getStockGroup($stockItemID, true) as $id) {
//                $sql = "SELECT DiscountPercentage
//FROM specialdeals
//WHERE StockGroupID = " . $id['StockGroupID'];
//                $discount = (mysqli_fetch_array(getFromDB($sql), MYSQLI_ASSOC)["DiscountPercentage"]);
//                if ($discount) {
//                    return $discount;
//                }
//            }
//        }
//    } else {
//        $sql = "SELECT DiscountPercentage
//FROM specialdeals
//WHERE StockGroupID = ?";
//        $where = $stockGroupID;
//        $discount = (mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC)["DiscountPercentage"]);
//        return $discount;
//    }
//    return;
//}

function getReviews($stockItemID)
{
    $sql = "SELECT * FROM reviews WHERE StockItemID = ? ORDER BY ReviewID desc";
    $where = $stockItemID;
    return mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC);
}
function getAvgReviews($stockItemID){
    $sql = "SELECT AVG(Rating) FROM reviews WHERE StockItemID = ?";
    $where = $stockItemID;
    return mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC);
}
function insertReview($stockItemID, $UserID, $Name, $Rating, $Description){
    $sql = "INSERT INTO `reviews`(`StockItemID`, `UserID`, `Name`, `Rating`, `Description`) VALUES (?,?,?,?,?)";
    $conn = maakVerbinding();
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'iisis', $stockItemID, $UserID, $Name, $Rating, $Description);
    mysqli_stmt_execute($stmt);
    sluitVerbinding($conn);
    return;
}

function getMaxDiscountStockGroup($stockgroupID, $discount)
{
    $sql = "SELECT max(UnitPrice) from stockitems as S 
JOIN stockitemstockgroups as G on S.StockItemID = G.StockItemID
WHERE G.StockGroupID = ?";
    $where = $stockgroupID;
    $maxPrice = mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]["max(UnitPrice)"];
    return ceil($maxPrice * ($discount / 100));

}

?>