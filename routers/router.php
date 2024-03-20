<?php
namespace app\routers;

function request( string|object $controller, string $action){

    try{
        $namespaceController = "\\app\\controllers\\$controller";

        if (!class_exists($namespaceController)) {
            throw new \Exception("Controller não encotrado");
        }

        if (!method_exists($namespaceController, $action)) 
        {
            return new \Exception("Action $action de $controller não encontrada");
        }

        $ControllerClass = new $namespaceController();
        $ControllerClass->$action();

    }catch (\Exception $e){
        echo $e->getMessage();
    }
}


$routes = [
    "GET" => [
        "/"  => fn() => request("HomeController", "getIndex"),
        "/register" => fn() => request("RegisterController", "getRegister"),
        "/login" => fn() => request("LoginController", "getLogin")
    ],
    "POST"=> [
        "/register" => fn() => request("RegisterController", "postRegister"),
        "/login" => fn() => request("LoginController", "postLogin"),
    ],
];