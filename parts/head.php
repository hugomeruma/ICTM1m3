<?php
if (!isset($_SESSION)) {
    session_start();
    ob_start();
}
?>
    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/bootstrap.min.css"
          type="text/css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/style.css"
          type="text/css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/fontawesome-free-5.11.2-web/css/all.css">
    <title>WWI</title>
</head>
<body>
<?php
require __DIR__ . "/navbar.php";
?>