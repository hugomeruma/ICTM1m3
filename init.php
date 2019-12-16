<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
    ob_start();
}
require __DIR__ . "/databaseFuncties/databaseFuncties.php";
require __DIR__ . "/functies/algemeen.php";