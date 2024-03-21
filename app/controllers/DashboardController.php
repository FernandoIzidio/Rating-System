<?php 

namespace app\controllers;
use app\config\RootProject;


require_once "../app/config/config.php";
require_once  RootProject::getRootPath()->controllers . "/BaseController.php";

class DashboardController extends BaseController{
    public function getDashboard(){
        if (!$this->hasSession()){
            header("Location: login");
        }
        
        echo $this->getBlade()->render("Dashboard.dashboard");
    }

}