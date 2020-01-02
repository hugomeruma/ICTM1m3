<?php
// default functies verbinden
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

function getStockGroup($where)
{
    $sql = "SELECT StockGroupID FROM stockitemstockgroups where StockItemID = ?;";
    $result = getFromDB($sql, $where);
    return (mysqli_fetch_all($result, MYSQLI_ASSOC));
}

//
//function getStockItem($stockItemID)
//{
//    $sql = "SELECT * FROM stockitems WHERE StockItemID = ?";
//    $where = $stockItemID;
//    return mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC);
//}

function haalVooraadOp($stockItemID)
{
    $sql = "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?";
    $where = $stockItemID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]['QuantityOnHand']);
}

function haalTempOp($IsChillerStock)
{
    if (empty($IsChillerStock)) {
        return;
    }
    $sql = "SELECT AVG(Temperature) as 'avgTemp' FROM coldroomtemperatures";
    return number_format((mysqli_fetch_all(getFromDB($sql), MYSQLI_ASSOC)[0]['avgTemp']), 2) . " &degC";
}


function haalKleurOp($ColorID)
{
    if (empty($ColorID)) {
        return;
    }
    $sql = "SELECT ColorName FROM colors WHERE ColorID = ?";
    $where = $ColorID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]['ColorName']);
}

function getSpecialDeals()
{
    $sql = "SELECT * FROM specialdeals;";
    return mysqli_fetch_all(getFromDB($sql), MYSQLI_ASSOC);
}

function price($StockItemID)
{
    $sql = "SELECT RecommendedRetailPrice, TaxRate FROM stockitems WHERE StockItemID = ?";
    $where = $StockItemID;
    $price = mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0];
    $price = $price['RecommendedRetailPrice'] * ((100 + $price['TaxRate']) / 100);
    $off = checkDiscount($StockItemID);
    $price = $price * ((100 - $off) / 100);
    if ($off != 0) {
        $GLOBALS['off'] = number_format($off, 0);
    }
    return number_format($price, 2);
}


function checkDiscount($stockItemID = null, $stockGroupID = null)
{
    if ($stockItemID != null) {
        $discount = getDiscount($stockItemID);
    } else {
        $discount = getDiscount(null, $stockGroupID);
    }
    return $discount;
}


function getDiscount($stockItemID = null, $stockGroupID = null)
{
    if ($stockItemID != null) {
        $sql = "SELECT DiscountPercentage
FROM specialdeals
WHERE StockItemID = ?";
        $where = $stockItemID;
        $discount = (mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC)["DiscountPercentage"]);
        if (!empty($discount['DiscountPercentage'])) {
            return $discount['DiscountPercentage'];
        } else {
            foreach (getStockGroup($stockItemID, true) as $id) {
                $sql = "SELECT DiscountPercentage
FROM specialdeals
WHERE StockGroupID = " . $id['StockGroupID'];
                $discount = (mysqli_fetch_array(getFromDB($sql), MYSQLI_ASSOC)["DiscountPercentage"]);
                if ($discount) {
                    return $discount;
                }
            }
        }
    } else {
        $sql = "SELECT DiscountPercentage
FROM specialdeals
WHERE StockGroupID = ?";
        $where = $stockGroupID;
        $discount = (mysqli_fetch_array(getFromDB($sql, $where), MYSQLI_ASSOC)["DiscountPercentage"]);
        return $discount;
    }
    return;
}

function getReviews($stockItemID)
{
    $sql = "SELECT * FROM reviews WHERE StockItemID = ? ORDER BY ReviewID desc LIMIT 3";
    $where = $stockItemID;
    return mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC);
}

function haalUserReviewOp($StockItemID)
{
    $sql = "SELECT * FROM reviews WHERE StockItemID = ? AND UserID = ?";
    $par1 = $StockItemID;
    $par2 = $_SESSION['id'];

    $conn = maakVerbinding();
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $par1, $par2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    sluitVerbinding($conn);
    $review = (mysqli_fetch_array($result, MYSQLI_ASSOC));
    return $review;

}

function getAvgReviews($stockItemID)
{
    $sql = "SELECT AVG(Rating) as 'avg', count(Rating) as 'count' FROM reviews WHERE StockItemID = ?";
    $where = $stockItemID;
    $array = mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0];
    return $array;
}


function reviewValidatie($StockItemID)
{
//    Slechtste code ooit van alex.
    if (isset($_SESSION['ingelogd'])) {
        $sql = "SELECT count(ReviewID) as 'count' FROM reviews WHERE StockItemID = ? AND UserID = ?";
        $par1 = $StockItemID;
        $par2 = $_SESSION['id'];

        $conn = maakVerbinding();
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $par1, $par2);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        sluitVerbinding($conn);
        $aantalReviews = (mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['count']);
        if ($aantalReviews == 0) {
            return 0;
        } else return 1;
    }
    return 2;
}

function insertReview($stockItemID, $UserID, $Name, $Rating, $Description)
{
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
    $sql = "SELECT max(RecommendedRetailPrice) from stockitems as S 
JOIN stockitemstockgroups as G on S.StockItemID = G.StockItemID
WHERE G.StockGroupID = ?";
    $where = $stockgroupID;
    $maxPrice = mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC)[0]["max(RecommendedRetailPrice)"];
    return ceil($maxPrice * ($discount / 100));
}

function stockgroupImages($stockGroupID)
{
    $sql = "SELECT ImageID FROM stockgroups_images WHERE StockGroupID = ?";
    $where = $stockGroupID;
    return (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC))[0] ?? '';
}

function stockItemImages($stockItemID)
{
    $sql = "SELECT ImageID FROM stockitems_images WHERE StockItemID = ?";
    $where = $stockItemID;

    $result = (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC));

    if (!empty($result)) {
        return $result;
    }

    return;
}

function getImageID($stockItemID)
{
    $array = array();

    $imageID = array();

    $imageID = stockItemImages($stockItemID);

    if (empty($imageID)) {
        $stockGroupIDs = getStockGroup($stockItemID);
        if (isset($_GET['categorie'])) {
            if ($_GET['categorie'] != "alle") {
                array_unshift($stockGroupIDs, Array("StockGroupID" => $_GET['categorie']));
            }
        }

        foreach ($stockGroupIDs as $stockGroupID) {
            $array[] = $stockGroupID["StockGroupID"];
        }

        $array = array_unique($array);
        foreach ($array as $stockGroupID) {
            $imageID[] = (stockgroupImages($stockGroupID));
        }
    }
    return $imageID;
}

function getImages($stockItemID, $isThumbnail = null)
{

    $imageIDs = getImageID($stockItemID);
    $images = array();

    $sql = "SELECT Location FROM images WHERE ID = ?";

    foreach ($imageIDs as $imageID) {
        echo "<br>";
        $where = $imageID["ImageID"] ?? '';
        $result = getFromDB($sql, $where);
        if ($result) {
            $images[] = (mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC));
        }
    }

    if ($isThumbnail != null) {
        return $images[0] ?? '';
    } else {
        return $images;
    }
}


function populaireProducten()
{
    $sql = "SELECT StockItemID FROM reviews ORDER BY Rating ASC LIMIT 3";
    return mysqli_fetch_all(getFromDB($sql), MYSQLI_ASSOC);
}

?>