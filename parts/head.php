<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="http://localhost/ICTM1m3/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Deze href werkt prima als je in de ICTM1m3/index.php gaat,
    maar als je in ICTM1m3/producten/index.php werkt het niet. De require in php regel 28 werkt prima.
        Geprobeerd =
            hele path, door middel van __DIR__ en door middel van $_SERVER.
            volledige path handmatig opgegeven.
    Bestaat er iets waar mee ik echt een path kan aan geven asl href zodat ik de hele path kan opgeven?-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <title>WWI</title>
    <?php
    echo "head.php <br>";
    echo $_SERVER['DOCUMENT_ROOT'] . "    (_SERVER['DOCUMENT_ROOT'])";
    echo "<br>";
    echo __DIR__ . "    (__DIR__)";

    // __DIR__ geeft C:\xampp\htdocs\ICTM1m3\parts
    // $_SERVER vraagt de root op dat is C:/xampp/htdocs
    require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/navbar.php" ?>
</head>
<body>