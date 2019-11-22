<?php
session_start();
require __DIR__ . '/functies/helpers.php';

if (isset($_SESSION)) {
    session_destroy();
}
redirect('');