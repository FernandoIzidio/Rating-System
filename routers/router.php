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
        "/"  => fn() => request("HomeController", "getHome"),
        "/register" => fn() => request("RegisterController", "getRegister"),
        "/login" => fn() => request("LoginController", "getLogin"), 
        "/dashboard" => fn() => request("DashboardController", "getDashboard"),
        "/dashboard/profile" => fn() => request("ProfileController", "getProfile"),
        "/dashboard/loggout" => fn() => request("LoggoutController", "loggout"),
        "/admin" => fn() => request("AdminController", "getAdmin"),
    ],
    "POST"=> [
        "/register" => fn() => request("RegisterController", "postRegister"),
        "/login" => fn() => request("LoginController", "postLogin"),
    ],
];