<?php
//default functies verbinden
function maakVerbinding()
{
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";

    $connection = new mysqli($host, $user, $pass, $databasename, $port);
    return ($connection);
}

function sluitVerbinding($connection)
{
    mysqli_close($connection);
}

//selecteren Producten
function fixPagination($count)
{
    $pp = pagination($count);
    return $pp;
}

function producten($stmt)
{
    $stmt->exectue;
    $result = $stmt->get_result;
    $producten = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $producten;
}

function offset($pp)
{
    $page = page();
    $offset = ($page - 1) * $pp;
    return $offset;
}

function alleProducten()
{
    $sql = "SELECT * FROM stockitems ";
    $producten = producten($sql);
    return $producten;
}

function selecterenZoeken($zoek)
{
    //  $sql= "SELECT * FROM WHERE LIKE $zoek"
    // $producten = producten($sql)

    //verklaren van wat zoek is, waar gezocht moet worden etc.
}


//catagorien
function stockgroups($sql)
{
    $connection = maakVerbinding();
    $stockgroups = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    sluitVerbinding($connection);
    return $stockgroups;
}

function ophalenStockgroups()
{
    $sql = "SELECT SG.StockGroupID, SG.StockGroupName 
FROM stockgroups as SG "; //JOIN stockitemsstockgroup as SISG ON SG.StockGroupID = SISG.StockGroupID
    $stockgroups = stockgroups($sql);
    return $stockgroups;
}

//sql injection needs to be fixed
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
        $countThis = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($countThis);
    } else {
        echo "SQL Statement failed";
    }

    sluitVerbinding($conn);
    $conn = maakVerbinding();
//fixPagination($count)
    $limit = fixPagination($count);
//offset($limit)
    $offset = offset($limit);
    $sql .= " LIMIT ? OFFSET ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'iii', $in, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $producten = mysqli_fetch_all($result, MYSQLI_ASSOC);
        sluitVerbinding($conn);
        return $producten;
    } else {
        echo "SQL Statement failed";
    }
    sluitVerbinding($conn);
    return;
}

?>