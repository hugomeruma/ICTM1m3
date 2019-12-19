<?php
function haalReviewsOp($stockItemID)
{
    $sql = "SELECT * FROM reviews WHERE StockItemID = ?";
    $where = $stockItemID;
    return mysqli_fetch_all(getFromDB($sql, $where), MYSQLI_ASSOC);
}

function reviewValidatie($StockItemID, $UserID)
{
//    Slechtste code ooit van alex.
    $sql = "SELECT count(ID) as 'count' FROM reviews WHERE StockItemID = ? AND UserID = ?";
    $par1 = $StockItemID;
    $par2 = $UserID;

    $aantalReviews = mysqli_fetch_all(getFromDB($sql, $par1, $par2), MYSQLI_ASSOC)[0]['count'];
    if ($aantalReviews == 0) {
        return true;
    } else return false;
}