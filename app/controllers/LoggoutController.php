<?php 
namespace app\controllers;

class LoggoutController{
    public function loggout(){
        session_unset();
        session_destroy();
        header("Location: /");
    }
    
}