<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!$_SESSION['ingelogd']) {
    redirect('login.php');
} elseif (!$_SESSION['isAdmin']) {
    redirect('');
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php getBaseUrl(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php getBaseUrl(); ?>/assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Admin - WWI</title>
</head>