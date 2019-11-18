<?php
//default functies verbinden
function maakVerbinding()
{
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";

    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    return ($connection);
}

function sluitVerbinding($connection)
{
    mysqli_close($connection);
}

//selecteren Producten
function producten($sql)
{
    $connection = maakVerbinding();
    $productenTotaal = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    $aantalProducten = count($productenTotaal);
    $pp = pagination($aantalProducten);
    $offset = offset($pp);
    $sql .= "LIMIT $offset, $pp";
    $productenTotaal = mysqli_fetch_all(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    sluitVerbinding($connection);
    return $productenTotaal;
}

function offset($pp)
{
    $page = page();
    $offset = ($page - 1) * $pp;
    return $offset;
}

function alleProducten()
{
    $sql = "SELECT StockItemID, StockItemName, UnitPrice, RecommendedRetailPrice FROM stockitems ";
    $producten = producten($sql);
    return $producten;
}

function selecterenZoeken($zoek)
{
    //  $sql= "SELECT * FROM WHERE LIKE $zoek"
    // $producten = producten($sql)

    //verklaren van wat zoek is, waar gezocht moet worden etc.
}

?>