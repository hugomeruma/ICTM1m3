<?php
function maakVerbinding($user = 'root', $pass = '')
{
    $host = 'localhost';
    $databasename = 'wideworldimporters';
    $port = 3306;
    $connection = new mysqli($host, $user, $pass, $databasename, $port);
    return $connection;
}

function sluitVerbinding($connection)
{
    mysqli_close($connection);
}