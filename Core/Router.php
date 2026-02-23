<?php

namespace Core;

use Core\Middleware\Middleware;

class Router{

    protected $routes = [];

    public function add($method, $uri, $controller, $middleware = null)
    {
        $this->routes[] = compact('method', 'uri', 'controller', 'middleware');

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        // only is the chained method, so whenever it is called, it means it is applied to the last element in the routes array
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                // get middleware class from the map and instantiate
                Middleware::resolve($route['middleware']);

                return require base_path("Http/controllers/{$route['controller']}");
            }
        }

        $this->abort();
    }

    // for aborting the request
    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("views/$code.php");

        die();
    }
}