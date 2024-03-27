<?php

namespace app\controllers;
use app\database\config\Connection;
use app\models\UserModel;

class HomeController extends BaseController{
    public function getView(){
        
        if ($this->hasAdmin()){
            $user = new UserModel(Connection::getConnection());

        
            
        }

        echo $this->getBlade()->render("home");
    }
    
}