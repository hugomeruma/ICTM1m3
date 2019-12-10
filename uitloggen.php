<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";

if (isset($_SESSION)) {
    session_destroy();
}
redirect('');
