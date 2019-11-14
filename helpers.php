<?php
function view($name, $data = [])
{
    extract($data);
    return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
    exit();
}

function dd($var)
{
    var_dump($var);
    die();
}