<?php

spl_autoload_register(function ($class) {
    $file = $class . '.php';

    if (file_exists($file)) {
        include_once $file;
    }
});

$router = new Router();

$router->get('/', 'home@index');
$router->post('/user/create', 'user@store');
$router->get('/user/([a-z]+)/profile', 'user@show');

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
