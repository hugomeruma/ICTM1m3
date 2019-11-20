<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <!-- <div class="dropdown-divider"></div>   dropdonw devider.-->
    <a> </a>
</div>

<?php
function productenInStockgroup()
{
    $sql = "SELECT SI.StockItemID, SI.StockItemName
FROM StockItems as SI JOIN stockitemstockgroups as SG 
ON SI.StockItemID = SG.StockItemID
WHERE SG.StockGroupID = ?";

    $conn = maakVerbinding();
    $in = $_GET['in'];

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $in);
        mysqli_stmt_execute($stmt);
        $count = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($count);
        fixPagination($count);
    } else {
        echo "SQL Statement failed";
    }
    echo "<br> $sql <br>";
    sluitVerbinding($conn);
    $conn = maakVerbinding();
//fixPagination($count)
    $limit = 10;
//offset($limit)
    $offset = 0;

    $sql .= " LIMIT ? OFFSET ?";

    $stmt = mysqli_stmt_init($conn);
    echo "<br> $sql <br>";

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'iii', $in, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $producten = mysqli_fetch_array($result, MYSQLI_ASSOC);
        print_r($producten);
    } else {
        echo "SQL Statement failed";
    }
    sluitVerbinding($conn);
    return $producten;
}
