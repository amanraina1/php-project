<?php

// route to controller mapping
function routeToController($uri, $routes) {

    if(array_key_exists($uri, $routes)) {

        require base_path($routes[$uri]);

    } else {

        abort();
    }
}

// for aborting the request
function abort($code = 404) {

    http_response_code($code);

    require base_path("views/$code.php");

    die();
}

$routes = require base_path("routes.php");
// this function is used to remove the query parameters from the ur and only get the actual url
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);