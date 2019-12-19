<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= getBaseUrl() ?>assets/afbeeldingen/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= getBaseUrl() ?>assets/css/bootstrap.min.css"
          type="text/css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>assets/css/hoofd.css"
          type="text/css">
    <link rel="stylesheet" href="<?= getBaseUrl() ?>assets/css/fontawesome-free-5.11.2-web/css/all.css">
    <title>WWI</title>
</head>
<body class="min-vh-100 ">
<?php
// Require categorie om de categorieën voor de navigatiebalk op te halen
require_once __DIR__ . '/../databaseFuncties/categorie.php';
require __DIR__ . '/navbar.php';
?>
<div class="container pt-3 pb-3 h-100">
