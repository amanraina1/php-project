<?php

// this function is used to remove the query parameters from the ur and only get the actual url
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// routes map
$routes = [

    '/' => 'controllers/index.php',

    '/about' => 'controllers/about.php',

    '/contact' => 'controllers/contact.php'
];

// route to controller mapping
function routeToController($uri, $routes) {

    if(array_key_exists($uri, $routes)) {

        require $routes[$uri];

    } else {

        abort();
    }
}

// for aborting the request
function abort($code = 404) {

    http_response_code($code);

    require "views/$code.php";

    die();
}

routeToController($uri, $routes);