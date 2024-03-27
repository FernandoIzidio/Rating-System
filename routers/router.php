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
        "/"  => fn() => request("HomeController", "getView"),
        "/register" => fn() => request("RegisterController", "getView"),
        "/login" => fn() => request("LoginController", "getView"), 
        "/dashboard" => fn() => request("DashboardController", "getView"),
        "/dashboard/profile" => fn() => request("ProfileController", "getView"),
        "/dashboard/assessments" => fn() => request("AssessmentsController", "getView"),
        "/dashboard/requests" => fn() => request("RequestsController", "getView"),
        "/admin" => fn() => request("AdminController", "getView"),
        "/loggout" => fn() => request("LoggoutController", "loggout"),
    ],
    "POST"=> [
        "/register" => fn() => request("RegisterController", "postView"),
        "/login" => fn() => request("LoginController", "postView"),
    ],
];