<?php

namespace app\controllers;
use app\database\config\Connection;
use app\models\ModelUser;


require_once "../app/controllers/BaseController.php";


class HomeController extends BaseController{
    public function getHome(){
        
        if ($this->hasAdmin()){
            require_once  "../app/models/User.php";
            require_once  "../app/database/config/connection.php";
            $user = new ModelUser(Connection::getConnection());

        
            
        }

        echo $this->getBlade()->render("home");
    }
    
}