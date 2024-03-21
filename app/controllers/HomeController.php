<?php

namespace app\controllers;
use app\config\RootProject;


require_once  "../app/config/config.php";
require_once RootProject::getRootPath()->controllers . "/BaseController.php";


class HomeController extends BaseController{
    public function getHome(){
        
        echo $this->getBlade()->render("home");
    }
    
}