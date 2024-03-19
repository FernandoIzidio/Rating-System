<?php 

session_start();
require '../vendor/autoload.php';
require '../routers/router.php';



try {
$route = parse_url($_SERVER['REQUEST_URI'])["path"];
$method = $_SERVER['REQUEST_METHOD'];

if (!array_key_exists($method, $routes)) {
    throw new Exception('404 error');
}


if (!array_key_exists($route, $routes[$method])) {
    throw new Exception('404 error');
}

$routes[$method][$route]();


} catch (Exception $e) {
    echo $e->getMessage();
}

