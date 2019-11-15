<?php
require 'helpers.php';

// Load routes
$routes = [];

// Check if route exists in routes.php
if ($_SERVER["REQUEST_METHOD"] == "POST" AND array_key_exists(self::getUri(), $routes["post"])){
    // Get function and functionFile by array key
    list($function, $functionFile) = explode("@", $routes["post"][self::getUri()]);
}
elseif (array_key_exists(self::getUri(), $routes["get"])){
    // Get controller and method by array key
    list($function, $functionFile) = explode("@", $routes["get"][self::getUri()]);
}
else{
    // If now route defined go to 404 page
    return redirect("404");
}

// Require functions file
require ("functies/{$functionFile}");

// Load function from functions file
$function();