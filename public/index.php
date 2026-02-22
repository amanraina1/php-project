<?php

use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . "Core/functions.php";

// for auto loading
// whenever there is a new instance of a class, and it has not been found, this fn will be triggered
spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

$router = new Router();
//require base_path("Core/Router.php");
$routes = require base_path("routes.php");

// this function is used to remove the query parameters from the ur and only get the actual url
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);