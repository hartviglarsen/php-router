<?php

final class Router {
    private array $routes;

    public function get(string $pattern, string $callback) : void {
        $this->addRoute('GET', $pattern, $callback);
    }

    public function post(string $pattern, string $callback) : void {
        $this->addRoute('POST', $pattern, $callback);
    }

    public function put(string $pattern, string $callback) : void {
        $this->addRoute('PUT', $pattern, $callback);
    }

    public function patch(string $pattern, string $callback) : void {
        $this->addRoute('PATCH', $pattern, $callback);
    }

    public function delete(string $pattern, string $callback) : void {
        $this->addRoute('DELETE', $pattern, $callback);
    }

    private function addRoute(string $method, string $pattern, string $callback) : void {
        $this->routes[] = new Route($pattern, $callback, $method);
    }

    public function route($uri, $method) : void {
        foreach ($this->routes as $route) {
            if (preg_match("#^$route->pattern$#", $uri, $matches) && $method === $route->method) { 
                $this->invoke($route, $matches);
                return;
            }
        }

        http_response_code(404);
    }

    private function invoke(Route $route, array $args) : void {
        list($controllerName, $action) = explode('@', $route->callback);
                
        array_shift($args);

        $controllerName = ucfirst($controllerName) . 'Controller';
        $controller = new $controllerName;

        echo $controller->{$action}(...array_values($args));
    }

    public function getRoutes() : array {
        return $this->routes;
    }
}
