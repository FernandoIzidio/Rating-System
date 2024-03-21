<?php 

namespace app\controllers;
use app\config\RootProject;

require_once "../app/config/config.php";
require_once  RootProject::getRootPath()->controllers . "/BaseController.php";

class HomeController extends BaseController{
    


    public function getHome(){
        $this->isvalidSession();
        require_once self::getRootPath()->views . "/logged.php";
    }
}