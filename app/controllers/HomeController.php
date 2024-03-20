<?php 

namespace app\controllers;

class HomeController {
    
    public function getHome(){
        include "../app/views/logged.php";
    }
}