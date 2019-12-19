<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
    ob_start();
}

require __DIR__ . "/databaseFuncties/algemeen.php";

require __DIR__ . "/functies/algemeen.php";
require __DIR__ . "/functies/content.php";

require __DIR__ . "/databaseFuncties/databaseFuncties.php";
