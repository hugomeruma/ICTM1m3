<?php
function redirect($path)
{
    echo "Location:" . getBaseURL() . $path;
    header("Location:" . getBaseURL() . $path);
    exit();
}

function dd($var)
{
    var_dump($var);
    die();
}
function da($array){
    print_r($array);
    die();
}